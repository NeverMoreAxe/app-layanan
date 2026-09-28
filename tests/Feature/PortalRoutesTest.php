<?php

namespace Tests\Feature;

use App\Enums\PublishStatus;
use App\Models\InformationPage;
use Tests\TestCase;

class PortalRoutesTest extends TestCase
{
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_service_catalog_page_is_accessible(): void
    {
        $response = $this->get('/layanan');
        $response->assertStatus(200);
    }

    public function test_dtsen_form_page_is_accessible(): void
    {
        $response = $this->get('/pengajuan/dtsen');
        $response->assertStatus(200);
    }

    public function test_pbi_form_page_is_accessible(): void
    {
        $response = $this->get('/pengajuan/pbi');
        $response->assertStatus(200);
    }

    public function test_track_ticket_page_is_accessible(): void
    {
        $response = $this->get('/cek-status');
        $response->assertStatus(200);
    }

    public function test_complaint_form_page_is_accessible(): void
    {
        $response = $this->get('/pengaduan');
        $response->assertStatus(200);
    }

    public function test_verify_certificate_page_is_accessible(): void
    {
        $response = $this->get('/verifikasi');
        $response->assertStatus(200);
    }

    public function test_faq_page_is_accessible(): void
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
    }

    public function test_service_detail_page_is_accessible_when_page_exists(): void
    {
        $page = InformationPage::where('publish_status', PublishStatus::Published)->first();
        if ($page) {
            $response = $this->get('/layanan/'.$page->slug);
            $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
