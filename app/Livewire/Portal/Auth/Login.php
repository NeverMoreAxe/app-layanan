<?php

namespace App\Livewire\Portal\Auth;

use App\Models\District;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.portal')]
#[Title('Masuk / Daftar Akun — SAPA SOSIAL')]
class Login extends Component
{
    public string $activeTab = 'login'; // 'login' or 'register'

    // Login Form Properties
    public string $loginIdentifier = ''; // NIK, Email, or Phone

    public string $loginPassword = '';

    public bool $remember = false;

    // Register Form Properties
    public string $name = '';

    public string $nik = '';

    public string $phone = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $districtId = '';

    public string $villageId = '';

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirect('/', navigate: true);

            return;
        }

        if (request()->routeIs('register') || request()->query('tab') === 'register') {
            $this->activeTab = 'register';
        }
    }

    public function updatedDistrictId(): void
    {
        $this->villageId = '';
    }

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetErrorBag();
    }

    public function login(): void
    {
        $this->validate([
            'loginIdentifier' => 'required|string',
            'loginPassword' => 'required|string',
        ], [
            'loginIdentifier.required' => 'Masukkan NIK, Email, atau No. WhatsApp Anda.',
            'loginPassword.required' => 'Masukkan kata sandi Anda.',
        ]);

        $identifier = trim($this->loginIdentifier);

        // Find user by email, nik, or phone
        $user = User::where('email', $identifier)
            ->orWhere('nik', $identifier)
            ->orWhere('phone', $identifier)
            ->first();

        if (! $user || ! Hash::check($this->loginPassword, $user->password)) {
            $this->addError('loginIdentifier', 'Kombinasi NIK/Email/No. HP dan kata sandi tidak cocok.');

            return;
        }

        if (! $user->is_active) {
            $this->addError('loginIdentifier', 'Akun Anda berstatus non-aktif. Silakan hubungi admin Dinas Sosial.');

            return;
        }

        Auth::login($user, $this->remember);
        session()->regenerate();

        // If user is admin/staff, offer or direct to admin panel, otherwise home
        if ($user->hasAnyRole(['Super Admin', 'Admin', 'Kepala Dinas', 'Kabid', 'Verifikator', 'Petugas', 'Operator Kecamatan', 'Operator Desa'])) {
            $this->redirect(route('filament.admin.pages.dashboard', absolute: false), navigate: false);

            return;
        }

        $this->redirect(session()->pull('url.intended', '/'), navigate: true);
    }

    public function register(): void
    {
        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'nik' => 'required|string|size:16|unique:users,nik',
            'phone' => ['required', 'string', 'regex:/^08[0-9]{8,13}$/', 'unique:users,phone'],
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'districtId' => 'nullable|exists:districts,id',
            'villageId' => 'nullable|exists:villages,id',
        ], [
            'name.required' => 'Nama lengkap wajib diisi sesuai KTP.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus berjumlah 16 digit.',
            'nik.unique' => 'NIK ini telah terdaftar di sistem SAPA SOSIAL.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.regex' => 'Format nomor WhatsApp tidak valid (contoh: 081234567890).',
            'phone.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $this->name,
            'nik' => $this->nik,
            'phone' => $this->phone,
            'email' => $this->email ?: null,
            'password' => Hash::make($this->password),
            'district_id' => $this->districtId ?: null,
            'village_id' => $this->villageId ?: null,
            'is_active' => true,
        ]);

        // Assign default citizen role if role exists
        if (Role::where('name', 'Masyarakat')->exists()) {
            $user->assignRole('Masyarakat');
        }

        Auth::login($user, true);
        session()->regenerate();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.portal.auth.login', [
            'districts' => District::orderBy('name')->get(),
            'villages' => $this->districtId
                ? Village::where('district_id', $this->districtId)->orderBy('name')->get()
                : collect(),
        ]);
    }
}
