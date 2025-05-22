<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
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
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Shanerbaner82\PanelRoles\PanelRoles;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;

class PersonalPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('personal')
            ->path('personal')
            ->font('Poppins')
            ->brandName('Administratie')
            ->brandLogo(asset('laus/logo.png'))
            ->favicon(asset('laus/favicon.png'))
            ->login()
            ->default()
            ->colors([
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Purple,
            ])
            ->discoverResources(in: app_path('Filament/Personal/Resources'), for: 'App\\Filament\\Personal\\Resources')
            ->discoverPages(in: app_path('Filament/Personal/Pages'), for: 'App\\Filament\\Personal\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Personal/Widgets'), for: 'App\\Filament\\Personal\\Widgets')
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
            ->databaseNotifications()
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/swisnl/filament-backgrounds/curated-by-swis')
                    ),
                SpotlightPlugin::make(),
                PanelRoles::make()
                    ->roleToAssign('client')
                    ->restrictedRoles(['super_admin', 'client']),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Admin')
                    ->url('/intranetlaus')
                    ->icon('heroicon-c-arrow-path')
                    ->visible(function () {
                        if (auth()->user()?->hasAnyRole([
                            'super_admin',
                        ])) {
                            return true;
                        } else {
                            return false;
                        }
                        return false;
                    }),
                MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-c-user-circle')
                    ->url('/personal/users/editProfile'),
            ]);
    }
}
