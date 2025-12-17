# 📦 Laravel KeepzEcommerce Integration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/class-atlas/laravel-keepz-ecommerce.svg?style=flat-square)](https://packagist.org/packages/class-atlas/laravel-keepz-ecommerce)
[![Total Downloads](https://img.shields.io/packagist/dt/class-atlas/laravel-keepz-ecommerce.svg?style=flat-square)](https://packagist.org/packages/class-atlas/laravel-keepz-ecommerce)

This Laravel package provides seamless integration with [Keepz](https://keepz.me)'s
eCommerce [API](https://www.developers.keepz.me/category/ecommerce--pay-via-keepz) — allowing your
application to create, monitor, and manage online orders with ease.

Whether you're creating new orders, tracking their statuses, or canceling them — this package simplifies the interaction
with Keepz's API using elegant PHP DTOs and Laravel-style conventions.

---

## 📌 Features

- 🛒 Create Orders
- 🔍 Check Order Status
- ❌ Cancel Orders

---

## 🧱 Installation

Install the package via Composer:

```bash
composer require class-atlas/laravel-keepz-ecommerce
```

---

## ⚙️ Configuration

Add the following to your `.env` file:

```env
KEEPZ_ECOMMERCE_PRIVKEY=<path_to_keepz_priv_key>
KEEPZ_ECOMMERCE_PUBKEY=<path_to_keepz_pub_key>
KEEPZ_ECOMMERCE_API_URL=https://gateway.keepz.me/ecommerce-service
KEEPZ_ECOMMERCE_INTEGRATOR_ID=<integrator_id>
```

ℹ️ Note:
Public and private key files must be placed under the storage directory.
For example:

* storage/keepz/privkey
* storage/keepz/pubkey

The values in your .env file should be relative paths from the storage folder, not full system paths.

* keepz/privkey
* keepz/pubkey

## 🛒 Create Order

Use the `createOrder` method to create a new order with Keepz:

```php
    $uuid = Str::uuid();
            
    $orderData = OrderData::from([
        'receiverId' => $merchant->keepz_id,
        'integratorOrderId' => $uuid,
        'successRedirectUri' => route('order.success'),
        'failRedirectUri' => route('order.error'),
        'amount' => $amount,
    ]);

    $orderData = KeepzEcommerce::createOrder($orderData);

    if ($orderData instanceof ErrorData) {
        if (app()->environment('production')) {
            abort(500);
        } else {
            return $orderData;
        }
    }

    return redirect()->away($orderData->urlForQR);
```

Returns either:

- `CreateOrderData` on success
- `ErrorData` on failure (includes error code and message)

---

## 🔍 Check Order Status

Use `checkOrderStatus` to retrieve the latest status of a specific order:

```php
KeepzEcommerce::checkOrderStatus($uuid);
```

Returns either:

- `CheckOrderStatusData` (includes status, timestamps, etc.)
- `ErrorData` (if order not found or request fails)

---

## ❌ Cancel Order

Use `cancelOrder` to cancel an existing order via its `integratorOrderId`:

```php
KeepzEcommerce::cancelOrder($uuid);
```

Returns:

- `CancelOrderData` (contains confirmation and status)

---

## 🧱 Data Transfer Objects

Each API response is automatically converted into a strict typed DTO (Data Transfer Object), making it easy to work with
structured responses in a Laravel-ish way.

- ✅ No need to parse JSON manually
- ✅ IntelliSense & static analysis friendly

---
