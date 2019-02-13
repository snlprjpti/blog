<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
            ->clickLink('Register')
            ->assertSee('Register')
            ->value('#name', 'Charles');
            $browser->pause(1000)
            ->value('#email', 'sl.prjpti@gmail.co')
                ->value('#password', 'sunil1')
                ->value('#password-confirm', 'sunil1')
                ->click('button[type="submit"]'); //Click the submit button on the page
                    $browser->pause(1000)
                ->assertPathIs('/dashboard');


            //Make sure you are in the home page
            //Make sure you see the phrase in the arguement
        });
        $this->browse(function ($browser) {
            $browser->visit('/') //Go to the homepage
            ->clickLink('Login') //Click the Login link
            ->assertSee('Login') //Make sure the phrase in the arguement is on the page
            //Fill the form with these values
                ->value('#email', 'sl.prjpti@gmail.com')
                ->value('#password', 'sunil')
                ->click('button[type="submit"]') //Click the submit button on the page
                ->assertPathIs('/dashboard'); //Make sure you are in the home page
                //Make sure you see the phrase in the arguement
        });
    }
}
