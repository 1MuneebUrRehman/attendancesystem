<h1 align="center">Attendance Management System</h1>


Attendance Management System have two(2) main Users (Teacher and Student). Student mark his/her attendance once in a day and also ask for a Leave to the teacher. Teacher see and download the attendance of individual student and all students. And also Accept and Reject the Student Leaves and more.



## Installation

Clone the project

```bash
  git clone https://github.com/1MuneebUrRehman/attendancesystem.git
```

Go to the project directory

```bash
  cd my-project
```
Install Composer Dependencies
```bash
  composer install
```

Install NPM dependencies

```bash
  npm install
  npm run dev

```

Create a copy of your .env file and Change the Database

```bash
  cp .env.example .env
```

Generate an app encryption key

```bash
  php artisan key:generate
```

Migrate the database

```bash
  php artisan migrate
```

  
## Deployment

To serve this project

```bash
  php artisan serve
```

  
## Authors

- [@muneeburrehman](https://www.github.com/1muneeburrehman)

  
