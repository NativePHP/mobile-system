## nativephp/system

System-level operations for NativePHP Mobile apps.

### Installation

```bash
composer require nativephp/system
php artisan native:plugin:register nativephp/system
```

### PHP Usage (Livewire/Blade)

Use the `System` facade:

@verbatim
<code-snippet name="Opening App Settings" lang="php">
use Native\Mobile\Facades\System;

// Open app settings (useful when user denied permissions)
System::openAppSettings();
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="Handling Denied Permissions" lang="php">
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\System;
use Native\Mobile\Facades\Dialog;

public function takePhoto()
{
    $result = Camera::getPhoto();

    if (isset($result['error']) && str_contains($result['error'], 'permission')) {
        // Permission denied, offer to open settings
        Dialog::alert(
            'Permission Required',
            'Camera access is needed. Please enable it in Settings.',
            ['Cancel', 'Open Settings']
        )->id('permission-alert');
    }
}

#[OnNative(ButtonPressed::class)]
public function handleButton($index, $label, $id)
{
    if ($id === 'permission-alert' && $label === 'Open Settings') {
        System::openAppSettings();
    }
}
</code-snippet>
@endverbatim

### JavaScript Usage

@verbatim
<code-snippet name="System Operations in JavaScript" lang="js">
import { system, dialog } from '#nativephp';

// Open app settings
await system.openAppSettings();

// Example: Handle permission denied
async function requestCameraPermission() {
    try {
        await camera.getPhoto();
    } catch (error) {
        if (error.message.includes('permission')) {
            dialog.alert(
                'Permission Required',
                'Camera access is needed. Please enable it in Settings.',
                ['Cancel', 'Open Settings']
            ).id('permission-alert');
        }
    }
}
</code-snippet>
@endverbatim

### Available Methods

- `System::openAppSettings()` - Opens the app's settings screen in device settings

### Return Values

**openAppSettings():** `{ success: true }`

### Use Cases

- Directing users to grant permissions after initial denial
- Allowing users to change notification preferences
- Enabling users to manage app-specific settings

### Platform Details

- **Android**: Opens app detail settings via `ACTION_APPLICATION_DETAILS_SETTINGS`
- **iOS**: Opens app-specific settings via `UIApplication.openSettingsURLString`