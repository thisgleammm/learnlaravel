<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Person;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDependencyInjectionServiceContainer()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('foo', $foo->foo());
        self::assertEquals('foo', $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("John", "Doe");
        });

        $person1 = $this->app->make(Person::class); // closure dipanggil
        $person2 = $this->app->make(Person::class); // closure dipanggil

        self::assertEquals("John", $person1->firstName);
        self::assertEquals("John", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {

        $this->app->singleton(Person::class, function ($app) {
            return new Person("John", "Doe");
        });

        $person1 = $this->app->make(Person::class); // if not exist
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals("John", $person1->firstName);
        self::assertEquals("John", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("John", "Doe");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals("John", $person1->firstName);
        self::assertEquals("John", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjectionClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // app()->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Halo, Budi", $helloService->hello("Budi"));
    }
}
