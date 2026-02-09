# CertiTrack App

A simple, reliable certificate tracking and verification system built with PHP. CertiTrack helps organizations issue, manage, and validate certificates efficiently while giving recipients a fast way to confirm authenticity.

---

## 🚀 Overview

CertiTrack is designed to eliminate the stress of manual certificate verification. With a structured admin panel and a public tracking interface, organizations can confidently distribute certificates while preventing fraud.

**Core goals:**

- Improve certificate credibility
- Simplify verification
- Centralize certificate management
- Reduce administrative workload

---

## ✨ Features

✅ **Certificate Verification**
Users can quickly verify certificates using a unique tracking reference.

✅ **Admin Dashboard**
Manage certificates, monitor activity, and control uploads from a centralized interface.

✅ **Secure Storage**
Certificates are stored and retrieved in an organized structure.

✅ **Fast Preview System**
Preview certificates before validation.

✅ **Lightweight & Efficient**
Built with PHP for speed and simplicity — no heavy frameworks required.

---

## 🧰 Tech Stack

- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache (XAMPP or similar)
- **Frontend:** HTML, CSS

---

## 📁 Project Structure

```
certitrack-app/
│
├── admin/                # Admin dashboard and certificate management
├── db.php                # Database connection
├── index.php             # Entry point
├── track.php             # Certificate tracking logic
├── preview.php           # Certificate preview
└── .gitignore
```

---

## ⚙️ Installation

### 1️⃣ Clone the repository

```bash
git clone https://github.com/LizeeRaphael/certitrack-app.git
```

### 2️⃣ Move into the project

```bash
cd certitrack-app
```

### 3️⃣ Set up your database

- Create a MySQL database
- Update the credentials inside **db.php**

### 4️⃣ Start your server

Place the project inside your server directory (e.g., XAMPP `htdocs`) **or configure Apache to point to the project folder.**

### 5️⃣ Launch the app

Open in your browser:

```
http://localhost/certitrack-app
```

---

## 🔐 Recommended Improvements (Future Enhancements)

- Role-based admin permissions
- Email certificate delivery
- QR-code verification
- Audit logs
- REST API support
- Cloud storage integration

---

## 🤝 Contributing

Contributions are welcome!

If you'd like to improve this project:

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Open a pull request

---

## 📄 License

This project is open-source and available under the **MIT License**.

---

## 👤 Author

**Lizee Raphael**
GitHub: [https://github.com/LizeeRaphael](https://github.com/LizeeRaphael)

---

## ⭐ Support

If you found this project useful, consider giving it a star — it helps others discover it!
