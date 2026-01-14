# System Plugin for NativePHP Mobile

System-level operations for NativePHP Mobile apps.

## Overview

The System API provides access to system-level functionality like opening the app's settings page.

## Installation

```bash
composer require nativephp/mobile-system
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\System;

// Open app settings (useful when user denied permissions)
System::openAppSettings();
```

### JavaScript (Vue/React/Inertia)

```js
import { system } from '#nativephp';

// Open app settings
await system.openAppSettings();
```

## Methods

### `openAppSettings(): array`

Opens the app's settings screen in the device settings. This is useful when a user has denied a permission and you want to direct them to the settings to grant it.

**Returns:** `{ success: true }`

## Use Cases

- Direct users to grant permissions after initial denial
- Allow users to change notification preferences
- Enable users to manage app-specific settings

## License

MIT