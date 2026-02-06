<?php
uses(Tests\TestCase::class);

it('never uses production database', function () {
    expect(config('app.env'))->toBe('testing');

    expect(config('database.default'))->not->toBe('donation_backend');
});
