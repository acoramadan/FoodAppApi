# SIMPLE CRUD API FOR FOODAPP
This repo its only for my side project that im currently working on. And trying to make an crud API

# API Documentation

This documentation provides a comprehensive guide on how to use the API for user authentication and other related operations.

---

## Base URL

All API requests should be made to the following base URL:
127.0.0.1/FoodApp/api/v1

---

## Authentication

All endpoints (except `/login`) require authentication. Include the `token` received from the `/login` endpoint in the `Authorization` header for authenticated requests.

Example:


---

## Endpoints

### 1. Login

Authenticate a user and retrieve a token.

**URL:** `/login`

**Method:** `POST`

#### Request

**Headers:**
- `Content-Type: application/json`

**Body:**
```json
{
    "email": "user@gmail.com",
    "password": "password123"
}
```
**Success Respons:**
```json
{
    "data": [
        {
            "error": false,
            "message": "Login Success",
            "status": 200,
            "user": {
                "id": "oNnHwjSR1G4E5L8Mute61w==",
                "username": "fulan123",
                "token": "5076739308fb17f70775b82298dacdf1970d0cef427b5d5fd742142984b1e840"
            }
        }
    ]
}
```
**Failed Respons:**
```json

{
    "error": true,
    "message": "Invalid email or password",
    "status": 400
}
```
### 2. Get user Profile

Authenticate a user and retrieve a token.

**URL:** `/profile`

**Method:** `GET`

#### Request

**Headers:**
- `Authorization: Bearer <token>`

**Success Respons:**
```json

{
    "data": [
        {
            "error": false,
            "message": "Profile retrieved successfully",
            "status": 200,
            "user": {
                "id": "oNnHwjSR1G4E5L8Mute61w==",
                "username": "Fulan",
                "email": "user@gmail.com",
                "noPhone": "0898xxxxxx"
            }
        }
    ]
}
```
**Failed Respons:**
- `Missing token or invalid token:`

```json
{
    "error": true,
    "message": "Unauthorized: Invalid or missing token",
    "status": 401
}
```
- `User not Found:`
```json
{
    "error": true,
    "message": "User not found",
    "status": 404
}
```
- `Internal server error:`
```json
{
    "error": true,
    "message": "Internal Server Error",
    "status": 500
}
```


