<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailable;
use Tests\TestCase;

class Exercise1Test extends TestCase
{
    use RefreshDatabase;

    const EMAIL_FROM_ADDRESS = 'test@byancode.com';
    const EMAIL_FROM_NAME = 'Byancode';

    private function runSeeds(): void
    {
        $this->seed();

        if (\class_exists('\Database\Seeders\NewsletterSeeder')) {
            $this->seed('\Database\Seeders\NewsletterSeeder');
        }
    }

    public function test_existe_el_model_newsletter(): void
    {
        $this->assertTrue(class_exists('App\Models\Newsletter'));
    }

    public function test_existe_el_modelo_newslettershipped(): void
    {
        $this->assertTrue(class_exists('App\Mail\NewsletterShipped'));
    }

    public function test_direccion_correcta_de_correo_del_sistema(): void
    {
        $this->assertEquals(static::EMAIL_FROM_ADDRESS, config('mail.from.address'));
    }

    public function test_nombre_correcto_de_correo_del_sistema(): void
    {
        $this->assertEquals(static::EMAIL_FROM_NAME, config('mail.from.name'));
    }

    public function test_existe_tabla_pivot_entre_newsletter_y_users(): void
    {
        $this->assertTrue(DB::getSchemaBuilder()->hasTable('newsletter_user'));
    }

    public function test_existe_comando_users_send_newsletter(): void
    {
        $this->artisan('list')->expectsOutputToContain('users:send-newslatter');
    }

    public function test_verificar_propiedad_subject_en_el_modelo_newsletter(): void
    {
        $this->assertTrue(class_exists('App\Models\Newsletter'));
        $model = new \App\Models\Newsletter();
        $this->assertTrue($model->isFillable('subject'));
    }

    public function test_subject_correcto_de_newsletter(): void
    {
        $this->runSeeds();

        $this->assertDatabaseCount('newsletters', 1);
        $model = DB::table('newsletters')->first();
        $this->assertEquals('Nueva actualizacion del sistema', $model->subject);
    }

    public function test_verificar_10_mil_usuarios_registrados() : void
    {
        $this->runSeeds();
        $this->assertDatabaseCount('users', 10000);
    }

    public function test_existe_el_comando_en_schedule(): void
    {
        $this->artisan('schedule:list')->expectsOutputToContain('users:send-newslatter');
    }

    public function test_se_ejecuto_correctamente_10_consultas(): void
    {
        $this->runSeeds();
        $this->artisan('users:send-newslatter')->assertSuccessful();
        $this->expectsDatabaseQueryCount(10);
    }

    public function test_se_registraron_mil_usuarion_en_relacion_con_newsletter(): void
    {
        $this->runSeeds();
        $this->artisan('users:send-newslatter')->assertSuccessful();
        $this->expectsDatabaseQueryCount(10);
    }

    public function test_comando_users_send_newsletter_ejecutado_correctamente(): void
    {
        Mail::fake();
        $this->runSeeds();
        $this->artisan('users:send-newslatter')->assertSuccessful();
        Mail::assertQueued('App\Mail\NewsletterShipped');
    }
}
