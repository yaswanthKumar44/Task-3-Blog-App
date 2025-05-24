### Task 2: Advanced Features Implementation
- **Objective**: Enhance the application with search, pagination, and UI improvements.
- **Features**:
  - Search functionality to find posts by title or content.
  - Pagination to display 5 posts per page with navigation links.
  - Responsive UI using Bootstrap 5 and custom CSS for improved UX.
- **Deliverables**:
  - Updated application with search and pagination.
  - Improved user interface design.
- **Timeline**: 10 days

### Development Environment Setup
- **Objective**: Set up a local development environment with PHP, MySQL, Git, and a code editor.
- **Tools**:
  - Local server: XAMPP
  - Code editor: Visual Studio Code with PHP extensions
  - Version control: Git and GitHub
- **Deliverables**:
  - Configured development environment.
  - Initialized Git repository with basic project structure (`index.php`, `README.md`).
- **Timeline**: 3 days
Features
User Authentication:
Register and login with secure password hashing (bcrypt).

Session management for user login states.

CSRF protection for all forms.

CRUD Operations:
Create: Add new posts via a form (admin only).

Read: Display a paginated list of posts or a single post.

Update: Edit existing posts (admin only).

Delete: Remove posts (admin only).

Search Functionality:
Search posts by title or content with pagination (5 posts per page).

Pagination:
Display 5 posts per page with navigation links (Previous, Next, page numbers).

User Interface:
Responsive design with Bootstrap 5.

Custom CSS for modern styling (shadows, hover effects, rounded corners).

Flash messages for user feedback.

Security
PDO with prepared statements to prevent SQL injection.

CSRF tokens for form submissions.

Password hashing with bcrypt.

Input sanitization and XSS prevention using htmlspecialchars.

Deliverables
Task 1:
Functional CRUD application with user authentication.

Database schema (database.sql).

PHP code for all functionality.

Task 2:
Enhanced application with search and pagination.

Improved UI with Bootstrap 5 and custom CSS.

Development Environment:
Configured XAMPP, Visual Studio Code, and Git.

Initialized Git repository with basic structure (index.php, README.md).

Timelines
Development Environment Setup: 3 days

Task 1 (Basic CRUD Application): 10 days

Task 2 (Advanced Features Implementation): 10 days

Usage
View Posts: Access index.php to see a paginated list of posts.

Search Posts: Use the search bar in the navbar to find posts by title or content.

Manage Posts: Log in as an admin to create, edit, or delete posts via admin/dashboard.php.

Register/Login: Use auth/register.php to create a new account or auth/login.php to log in.

Troubleshooting
Database Errors: Ensure MySQL credentials in config.php match your setup and database.sql is imported correctly.

Git Push Issues: Use a Personal Access Token for authentication or set up SSH keys.

URL Rewriting: If using .htaccess, ensure mod_rewrite is enabled in Apache and AllowOverride All is set in httpd.conf.

Future Enhancements
Add categories or tags for posts.

Implement a comments system for user interaction.

Integrate a rich text editor (e.g., CKEditor) for post creation.

Expose an API using xAI's API service (see x.ai/api).

Add unit tests with PHPUnit.

