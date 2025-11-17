# API Places – Laravel + Docker

This project provides a simple REST API for managing places, built with **Laravel 10** and fully containerized using **Docker**.

---

##  Requirements
- Docker & Docker Compose
- Git

---

##  Clone the Repository
```bash
git clone https://github.com/leeofeer/api.git
cd api
```

---

## 🐳 Start the Docker Environment

### 1. Build and start containers
```bash
docker compose up -d --build
```
This will start:
- `app` → PHP + Laravel container
- `db` → PostgreSQL
- `nginx` → Web server

---

## ⚙️ Laravel Setup Inside the Container

Enter the application container:
```bash
docker exec -it app bash
```

### 2. Install dependencies
```bash
composer install
```

### 3. Copy the environment file
```bash
cp .env.example .env
```

### 4. Generate the application key
```bash
php artisan key:generate
```

### 5. Run migrations
```bash
php artisan migrate
```

---

## 📌 Available Endpoints
Controller: `App\Http\Controllers\v1\PlacesController`

### **GET /api/places**
Returns all places.

Optional filter:
```
/api/places?name=text
```
Performs an ILIKE search on the name field.

---

### **POST /api/places**
Creates a new place.

**Request JSON:**
```json
{
  "name": "Central Park",
  "slug": "central-park",
  "city": "New York",
  "state": "NY"
}
```

---

### **GET /api/places/{id}**
Returns a single place by ID.

---

### **PUT /api/places/{id}**
Updates a place. All fields are optional.

**Example JSON:**
```json
{
  "name": "Updated Name",
  "city": "Updated City"
}
```

---

### **DELETE /api/places/{id}**
Deletes a place.

---

## 🧪 Testing the API
You may use:
- Postman
- Thunder Client (VS Code)
- curl

### Examples

**List places:**
```bash
curl http://localhost:8080/api/places
```

**Create a place:**
```bash
curl -X POST http://localhost:8080/api/places \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","slug":"test","city":"City","state":"State"}'
```

## 📂 Project Structure
```
app/
 ├── Http/Controllers/v1/PlacesController.php
 ├── Models/Places.php
docker/
nginx/
docker-compose.yml
```

---

## 📜 License
Open for development and free use.

