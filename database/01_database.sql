/* ==========================================================
   StayNest Database
   Startup MVP v1.0
   File : 01_database.sql
========================================================== */

/* ==========================================
   Drop Existing Database (Development Only)
========================================== */

DROP DATABASE IF EXISTS staynest;

/* ==========================================
   Create Database
========================================== */

CREATE DATABASE staynest
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

/* ==========================================
   Use Database
========================================== */

USE staynest;