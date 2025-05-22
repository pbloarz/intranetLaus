<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Navigation\MenuItem;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Shanerbaner82\PanelRoles\PanelRoles;

class IntranetlausPanelProvider extends PanelProvider
{
    public static function shouldRegisterSpotlight(): bool
    {
        return true;
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('intranetlaus')
            ->path('intranetlaus')
            ->login()
            ->colors([
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Purple,

            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/swisnl/filament-backgrounds/triangles')
                    ),
                SpotlightPlugin::make(),
                FilamentShieldPlugin::make(),
                PanelRoles::make()
                    ->roleToAssign('super_admin')
                    ->restrictedRoles(['super_admin']),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Client')
                    ->url('/personal')
                    ->icon('heroicon-c-arrow-path')
                    ->visible(function () {
                        if (auth()->user()?->hasAnyRole([
                            'super_admin','client'
                        ])) {
                            return true;
                        } else {
                            return false;
                        }
                        return false;
                    }),
            ]);
    }
}
