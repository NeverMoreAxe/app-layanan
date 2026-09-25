<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsByModule = [
            'service_requests' => [
                'view_any_service_request',
                'view_service_request',
                'create_service_request',
                'update_service_request',
                'delete_service_request',
                'verify_service_request',
                'approve_service_request',
            ],
            'dtsen_certificates' => [
                'view_any_dtsen',
                'view_dtsen',
                'create_dtsen',
                'check_siksng',
                'issue_dtsen',
                'sign_dtsen',
            ],
            'pbi_reactivations' => [
                'view_any_pbi',
                'view_pbi',
                'create_pbi',
                'verify_pbi_eligibility',
                'sign_pbi',
                'propose_pbi_ministry',
            ],
            'rehabilitation_cases' => [
                'view_any_rehab',
                'view_rehab',
                'create_rehab',
                'update_rehab',
                'assess_rehab',
                'refer_rehab',
                'monitor_rehab',
                'close_rehab',
            ],
            'complaints' => [
                'view_any_complaint',
                'view_complaint',
                'create_complaint',
                'update_complaint',
                'verify_complaint',
                'dispatch_complaint',
                'resolve_complaint',
            ],
            'information_pages' => [
                'view_any_info',
                'view_info',
                'create_info',
                'update_info',
                'publish_info',
                'archive_info',
            ],
            'users' => [
                'view_any_user',
                'view_user',
                'create_user',
                'update_user',
                'delete_user',
                'assign_roles',
            ],
            'master_data' => [
                'view_any_master',
                'view_master',
                'create_master',
                'update_master',
                'delete_master',
            ],
            'reports' => [
                'view_report',
                'export_report',
            ],
        ];

        foreach ($permissionsByModule as $module => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            }
        }

        // Roles definition
        $adminRole = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => 'web']);
        $petugasRole = Role::firstOrCreate(['name' => 'Petugas Dinsos', 'guard_name' => 'web']);
        $pejabatRole = Role::firstOrCreate(['name' => 'Pejabat Penandatangan', 'guard_name' => 'web']);
        $pimpinanRole = Role::firstOrCreate(['name' => 'Pimpinan', 'guard_name' => 'web']);
        $operatorRole = Role::firstOrCreate(['name' => 'Operator Kecamatan/Desa', 'guard_name' => 'web']);
        $masyarakatRole = Role::firstOrCreate(['name' => 'Masyarakat', 'guard_name' => 'web']);

        // Administrator: all permissions
        $adminRole->syncPermissions(Permission::all());

        // Petugas Dinsos: can handle requests, check siksng, handle rehab & complaints
        $petugasRole->syncPermissions([
            'view_any_service_request', 'view_service_request', 'update_service_request', 'verify_service_request',
            'view_any_dtsen', 'view_dtsen', 'check_siksng', 'issue_dtsen',
            'view_any_pbi', 'view_pbi', 'verify_pbi_eligibility', 'propose_pbi_ministry',
            'view_any_rehab', 'view_rehab', 'create_rehab', 'update_rehab', 'assess_rehab', 'refer_rehab', 'monitor_rehab', 'close_rehab',
            'view_any_complaint', 'view_complaint', 'update_complaint', 'verify_complaint', 'dispatch_complaint', 'resolve_complaint',
            'view_any_info', 'view_info', 'create_info', 'update_info',
            'view_report', 'export_report',
            'view_any_master', 'view_master',
        ]);

        // Pejabat Penandatangan: approve and sign
        $pejabatRole->syncPermissions([
            'view_any_service_request', 'view_service_request', 'approve_service_request',
            'view_any_dtsen', 'view_dtsen', 'sign_dtsen',
            'view_any_pbi', 'view_pbi', 'sign_pbi',
            'view_report', 'export_report',
        ]);

        // Pimpinan: read-only + reports
        $pimpinanRole->syncPermissions([
            'view_any_service_request', 'view_service_request',
            'view_any_dtsen', 'view_dtsen',
            'view_any_pbi', 'view_pbi',
            'view_any_rehab', 'view_rehab',
            'view_any_complaint', 'view_complaint',
            'view_any_info', 'view_info',
            'view_report', 'export_report',
        ]);

        // Operator Kecamatan/Desa: submit and view for their area
        $operatorRole->syncPermissions([
            'view_any_service_request', 'view_service_request', 'create_service_request',
            'view_any_dtsen', 'view_dtsen', 'create_dtsen',
            'view_any_pbi', 'view_pbi', 'create_pbi',
            'view_any_complaint', 'view_complaint', 'create_complaint',
            'view_any_info', 'view_info',
        ]);

        // Masyarakat: basic submissions
        $masyarakatRole->syncPermissions([
            'view_service_request', 'create_service_request',
            'view_dtsen', 'create_dtsen',
            'view_pbi', 'create_pbi',
            'view_complaint', 'create_complaint',
            'view_info',
        ]);

        // Assign roles to existing seeded users
        $roleMap = [
            'admin@sapasosial.blitarkab.go.id' => ['Administrator'],
            'tm.handoko43@gmail.com' => ['Administrator'],
            'kadis@sapasosial.blitarkab.go.id' => ['Pimpinan', 'Pejabat Penandatangan'],
            'kabid.dayasos@sapasosial.blitarkab.go.id' => ['Pejabat Penandatangan'],
            'kabid.linjamsos@sapasosial.blitarkab.go.id' => ['Pejabat Penandatangan'],
            'petugas.layanan@sapasosial.blitarkab.go.id' => ['Petugas Dinsos'],
            'petugas.rehsos@sapasosial.blitarkab.go.id' => ['Petugas Dinsos'],
            'operator.kanigoro@sapasosial.blitarkab.go.id' => ['Operator Kecamatan/Desa'],
            'operator.minggirsari@sapasosial.blitarkab.go.id' => ['Operator Kecamatan/Desa'],
            'budi.santoso@gmail.com' => ['Masyarakat'],
        ];

        foreach ($roleMap as $email => $roles) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->syncRoles($roles);
            }
        }
    }
}
