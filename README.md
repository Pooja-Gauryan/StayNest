# 🏡 StayNest – Student Accommodation Platform

**Find your space. Feel at home.**

StayNest is a full-stack web application designed to simplify the process of finding and managing student accommodation. It provides a platform where students can explore PGs, hostels, flats, and rental rooms, while property owners can list and manage their properties.

The platform aims to make accommodation discovery more convenient through property listings, images, amenities, wishlists, and direct messaging.

---

## 🌐 Live Demo

👉 [Visit StayNest](https://staynest.infinityfreeapp.com)

## 📂 GitHub Repository

👉 [View Source Code](https://github.com/Pooja-Gauryan/StayNest)

---

## 📸 Project Preview


<img width="433" height="208" alt="image" src="https://github.com/user-attachments/assets/bd8fd83b-2a5d-4726-869d-25d09440f275" />

![StayNest Homepage](<img width="433" height="208" alt="image" src="https://github.com/user-attachments/assets/cbc351e3-5ed8-49d3-9621-5b39cf839715" />
)

*StayNest Homepage*

![Property Listings](screenshots/properties.png)

*Property Listings*

![Property Details](screenshots/property-details.png)

*Property Details*

---

## ✨ Key Features

### 👤 User Authentication
- User registration and login.
- Session-based authentication.
- Secure password handling.
- User logout functionality.

### 🏠 Property Management
- Add new accommodation listings.
- Edit and delete property listings.
- Upload multiple property images.
- Add property details and amenities.
- Manage property availability.

### 🔍 Property Discovery
- Browse available accommodation options.
- Explore property details and images.
- View featured properties.
- Search and filter accommodation options.

### ❤️ Wishlist
- Save favourite properties.
- View saved properties.
- Remove properties from the wishlist.

### 💬 Messaging
- Start conversations between users.
- Send and receive messages.
- View conversation history.

### 🔔 Notifications
- View notifications.
- Mark notifications as read.

### ⚙️ User Profile
- View and update profile information.
- Change account password.

---

## 🛠️ Technology Stack

| Category | Technologies |
|---|---|
| Frontend | HTML5, CSS3, JavaScript |
| UI Framework | Bootstrap 5.3.3 |
| Icons | Bootstrap Icons |
| Backend | PHP |
| Database | MySQL |
| Database Connectivity | PDO |
| Authentication | PHP Sessions |
| APIs | PHP-based APIs |
| Hosting | InfinityFree |
| Version Control | Git & GitHub |

---

## 🗄️ Database Overview

StayNest uses a relational MySQL database to manage users, properties, communication, and other application data.

The database contains 12 tables:

| Table | Purpose |
|---|---|
| `users` | Stores user information |
| `properties` | Stores accommodation details |
| `amenities` | Stores available amenities |
| `property_amenities` | Connects properties with amenities |
| `property_images` | Stores property image information |
| `wishlist` | Manages saved properties |
| `conversations` | Stores conversation details |
| `messages` | Stores user messages |
| `bookings` | Booking-related database structure |
| `reviews` | Review-related database structure |
| `notifications` | Stores user notifications |
| `reports` | Stores report-related records |

---

## 🏗️ Application Architecture

StayNest follows a client-server architecture:

- **Frontend:** Provides the user interface and interactive experience.
- **Backend:** PHP handles application logic, authentication, and API requests.
- **Database:** MySQL stores and manages application data.
- **File Storage:** Uploaded property images are stored on the server.

### Application Flow

`User → Frontend → PHP Backend → MySQL Database`

---

## 🔐 Important Implementation Highlights

- PDO-based database connectivity.
- Session-based user authentication.
- Input validation in backend APIs.
- Database transactions for property creation.
- Soft deletion for property records.
- Image upload and metadata management.
- Ownership checks for property management.
- Separate APIs for different application modules.

---

## 🎯 Project Objectives

- Simplify accommodation discovery for students.
- Provide property owners with an online listing platform.
- Make property information easier to explore.
- Enable communication between users.
- Provide a centralized platform for accommodation-related information.

---

## 🚀 Future Enhancements

- Complete online booking workflow.
- Property review and rating functionality.
- Advanced search and location-based filtering.
- Map integration for property locations.
- Improved property verification and moderation.
- Enhanced notification experience.

---

## 📱 Scan to Explore StayNest

Want to explore the live application?

Scan the QR code below to visit StayNest.

<!-- Replace this path with your QR code image -->

![StayNest QR Code](screenshots/staynest-qr.png)

---

## 👩‍💻 Author

**Pooja**

B.Tech – Computer Science and Engineering

GitHub: [@Pooja-Gauryan](https://github.com/Pooja-Gauryan)

---

## ⭐ Support

If you find this project interesting, consider giving the repository a ⭐ on GitHub!

**StayNest – Making student accommodation discovery simpler.**
