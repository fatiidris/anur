# An-Nur School Management System

An-Nur School Management System is a comprehensive web application built with Laravel that provides a platform for managing school operations. It offers distinct roles for administrators, teachers, students, and parents, each with a tailored set of features to streamline communication, academic management, and administrative tasks.

This system is designed to be a central hub for all school-related activities, from managing student and teacher records to handling academic schedules, examinations, and fee collections. It aims to improve efficiency, foster better communication between stakeholders, and provide a seamless educational experience for everyone involved.

## Features

The application includes the following features, categorized by user role:

### Admin

- **User Management:** Add, edit, delete, and view lists of admins, teachers, students, and parents.
- **Academic Management:**
    - Manage classes and subjects.
    - Assign subjects to classes.
    - Create and manage class timetables.
- **Examinations:**
    - Create and manage examination schedules.
    - Record and manage student marks.
    - Define grading systems.
- **Attendance:**
    - Monitor student attendance.
    - Generate attendance reports.
- **Communication:**
    - Post and manage announcements on the notice board.
    - Send emails to users.
- **Homework:**
    - Assign homework to classes.
    - Track homework submissions.
- **Fee Collection:**
    - Manage fee collections from students.
    - View fee collection reports.
- **System Settings:** Configure application settings.

### Teacher

- **Account Management:**
    - Manage personal account details.
    - Change password.
- **Academic Information:**
    - View assigned classes and subjects.
    - Access class and exam timetables.
- **Student Management:**
    - View a list of their students.
    - Take student attendance.
- **Homework:**
    - Assign and manage homework for their classes.
    - View homework submissions.
- **Communication:**
    - View notices on the notice board.

## Installation

To set up the project locally, follow these steps:

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository/an_nur
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    ```

3.  **Create the environment file:**

    ```bash
    cp .env.example .env
    ```

4.  **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5.  **Configure the database:**

    Open the `.env` file and update the database credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=an_nur
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Run database migrations:**

    ```bash
    php artisan migrate
    ```

7.  **Start the development server:**

    ```bash
    php artisan serve
    ```

    The application will be available at `http://127.0.0.1:8000`.

## Database

The project includes a SQL file that can be used to seed the database with initial data. After creating your database, you can import the `database/an_nur.sql` file to populate the necessary tables.

**Note:** Using the SQL file is an alternative to running migrations and seeders. If you use the SQL file, you may not need to run `php artisan migrate`.

## User Roles and Credentials

The application has four user roles: Admin, Teacher, Student, and Parent.

To get started, you will need to create an admin user. You can do this by running the following command:

```bash
php artisan tinker
```

Then, run the following code to create a new admin user:

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'user_type' => 1
]);
```

After creating the admin user, you can log in with the following credentials:

-   **Email:** `admin@example.com`
-   **Password:** `password`

Once logged in, you can create new teachers, students, and parents through the admin panel.

### Student

- **Account Management:**
    - Manage personal account details.
    - Change password.
- **Academic Information:**
    - View their subjects and class timetable.
    - View exam schedules and results.
- **Attendance:**
    - View their attendance records.
- **Homework:**
    - View and submit homework assignments.
- **Fee Payment:**
    - View fee payment history.
    - Make online payments via Paystack.
- **Communication:**
    - View notices on the notice board.

### Parent

- **Account Management:**
    - Manage personal account details.
    - Change password.
- **Child's Academic Progress:**
    - View their child's subjects, class timetable, and exam results.
    - Monitor their child's attendance.
- **Homework:**
    - View their child's homework assignments and submissions.
- **Fee Payment:**
    - Manage their child's fee payments.
- **Communication:**
    - View notices on the notice board.
