# Koliba Zlatá Podkova Website

## Overview

This project is the official website for Koliba Zlatá Podkova, a venue located in Košice, Slovakia. The website provides visitors with information about the venue's offerings, which include a traditional Slovak restaurant, event hosting capabilities (such as for parties and weddings), accommodation options, and various sports and entertainment facilities. It allows users to view menus, see upcoming news/events, browse a gallery, and make reservations for different services.

## Features

*   **Venue Information:** Comprehensive details about Koliba Zlatá Podkova and its services.
*   **Menu Display:** Access to restaurant, beverage, and business menus (links to PDF files).
*   **News/Aktuality:** A dynamic section displaying the latest news and updates, loaded from a JSON file.
*   **Image Gallery:** A visual showcase of the venue, including restaurant, sports facilities, wedding setups, and accommodation.
*   **Contact Information:** Displays address, phone numbers, email, and a link to Google Maps.
*   **Online Reservations:**
    *   Restaurant booking (basic implementation).
    *   Sports fields reservations (tennis, football, etc.).
    *   Wedding inquiry form.
    *   Accommodation booking form.
    *   *Note: Form submissions are saved to JSON files.*
*   **Admin Panel:**
    *   Management of news/aktuality (add/delete).
    *   Viewing of submitted reservations (details depend on specific admin pages).
    *   Protected by a login mechanism.
*   **Responsive Design:** Based on the Bootstrap framework, ensuring compatibility across various devices.

## Technologies Used

*   **Frontend:**
    *   HTML5
    *   CSS3
    *   JavaScript
    *   [Bootstrap](https://getbootstrap.com/) (version 5, based on `assets/vendor/bootstrap/css/bootstrap.min.css`)
    *   [Animate.css](https://animate.style/)
    *   [AOS (Animate On Scroll)](https://michalsnik.github.io/aos/)
    *   [GLightbox](https://biati-digital.github.io/glightbox/)
    *   [Isotope](https://isotope.metafizzy.co/)
    *   [Swiper JS](https://swiperjs.com/)
*   **Backend:**
    *   PHP (for form processing and admin panel)
*   **Data Storage:**
    *   JSON files (for news, reservations, etc.)

## Project Structure

The project is organized into the following main directories:

*   **`/` (Root Directory):** Contains the main HTML pages for the website (e.g., `index.html`, `restaurant.html`, `wedding.html`, etc.).
*   **`admin/`:** Houses the PHP scripts and interface for the administration panel. This includes functionalities like managing news (`aktuality.php`), handling logins (`login.php`, `session_check.php`), and viewing various reservation types.
*   **`assets/`:** Contains all static assets used by the frontend.
    *   `assets/css/`: Custom CSS stylesheets for the template (`style.css`).
    *   `assets/img/`: Images used throughout the website.
    *   `assets/js/`: Custom JavaScript files (`main.js`).
    *   `assets/vendor/`: Third-party frontend libraries and frameworks (Bootstrap, AOS, GLightbox, etc.).
    *   PDF files for menus and other documents are also stored directly under `assets/`.
*   **`data/`:** Stores JSON files that act as a simple database for the application. This includes `aktuality.json` (for news items) and various `rezervacie_*.json` files for different types of bookings.
*   **`forms/`:** Contains PHP scripts responsible for processing form submissions from the website (e.g., `book-ihriska.php`, `save_to_json.php`).

## Setup and Installation

To set up and run this project locally, you will need a web server environment that supports PHP. Follow these steps:

1.  **Web Server:**
    *   Ensure you have a local web server environment like XAMPP (Windows, Linux, macOS), MAMP (macOS), WAMP (Windows), or a standalone Apache/Nginx server with PHP installed.
    *   PHP version 7.x or 8.x is recommended.

2.  **Download or Clone the Project:**
    *   Download the project files as a ZIP and extract them, or clone the repository using Git:
        ```bash
        git clone <repository-url>
        ```

3.  **Place Project in Web Server Directory:**
    *   Move the entire project folder into your web server's document root directory.
        *   For XAMPP/WAMP: This is typically `htdocs/`.
        *   For MAMP: This is typically `htdocs/` or a configurable folder.
        *   For standalone Apache: This is often `www/` or `public_html/`.

4.  **Permissions (Important):**
    *   The web server needs write permissions for the `data/` directory to save new entries from forms (reservations) and for the admin panel to manage news (`aktuality.json`).
    *   On Linux/macOS, you might need to set permissions:
        ```bash
        chmod -R 775 /path/to/your/project/data
        # You might also need to change ownership to the web server user (e.g., www-data, apache)
        # chown -R www-data:www-data /path/to/your/project/data
        ```
    *   Ensure the parent directory `../` relative to `forms/save_to_json.php` (which is the project root) is writable if the `data` directory doesn't exist and needs to be created by the script (though it's better to ensure `data/` exists with correct permissions).

5.  **Database (Note):**
    *   The file `admin/config.php` contains variables for a MySQL database connection (`$host`, `$user`, `$pass`, `$dbname`).
    *   However, the **current project primarily uses JSON files** in the `data/` directory for storing information like news and reservations.
    *   **No database setup is required** for the existing functionality to work.
    *   If you intend to integrate a MySQL database, you will need to:
        1.  Create a database with the specified name (or change it in `config.php`).
        2.  Update the PHP scripts in `forms/` and `admin/` to interact with the database instead of JSON files.

6.  **No Build/Compilation Step:**
    *   Being a PHP and HTML/CSS/JS project, there are no complex build or compilation steps required beyond setting up the server.

## Running the Project

Once you have completed the setup steps:

1.  **Start your web server** (e.g., start Apache and MySQL from the XAMPP control panel).
2.  **Open your web browser** (e.g., Chrome, Firefox, Edge).
3.  **Navigate to the project's URL.** This will typically be:
    *   `http://localhost/your-project-folder-name/`
    *   Replace `your-project-folder-name` with the actual name of the folder where you placed the project files.
    *   The main page should be `index.html`.

## Admin Panel

The website includes an administration panel for managing certain aspects of the site.

*   **Access:** The admin panel is accessible via `/admin/login.php`.
    *   Example: `http://localhost/your-project-folder-name/admin/login.php`

*   **Authentication:**
    *   The admin panel uses a PHP session-based login system (`admin/login.php`, `admin/session_check.php`).
    *   **Default Credentials:** The codebase does not explicitly state default admin credentials. You may need to:
        *   Check the `admin/login.php` script for any hardcoded credentials (not recommended for production).
        *   If using a database (which is not the default setup), credentials would be managed there.
        *   For the current JSON-based setup, the authentication mechanism might be simplified or require manual setup of user session/role if not explicitly defined in `login.php`. The `admin/aktuality.php` script checks `$_SESSION['role'] === 'admin'`.

*   **Functionality:**
    *   **Manage News (Aktuality):** Add new news items and delete existing ones via `admin/aktuality.php`. These are stored in `data/aktuality.json`.
    *   **View Reservations:** The admin panel likely contains pages to view submissions from the various reservation forms (e.g., `admin/rezervacie_ihriska.php`, `admin/rezervacie_restauracia.php`, etc.). These pages would read data from the corresponding JSON files in the `data/` directory.
    *   **Dashboard:** `admin/index.php` likely serves as a central dashboard for the admin area.

## Data Storage

This project primarily uses **JSON files** for data persistence instead of a traditional database. This approach simplifies setup for smaller applications.

*   **Location:** All data files are stored in the `data/` directory.
*   **Key Files:**
    *   `data/aktuality.json`: Stores news items displayed in the "Aktuality" section on the homepage and managed via the admin panel.
    *   `data/rezervacie_ihriska.json`: Stores reservations for sports fields.
    *   `data/rezervacie_restauracia.json`: Stores restaurant booking information.
    *   `data/rezervacie_svadby.json`: Stores wedding inquiries.
    *   `data/rezervacie_ubytovanie.json`: Stores accommodation booking requests.
*   **Mechanism:**
    *   PHP scripts in the `forms/` directory (specifically `forms/save_to_json.php`) handle appending new data to these JSON files when users submit forms.
    *   PHP scripts in the `admin/` directory read from these files to display reservation details and manage news.
*   **Permissions:** As noted in the "Setup and Installation" section, the `data/` directory must be writable by the web server for the application to function correctly.

## Template Information

The frontend design of this website is based on a Bootstrap template.

*   **Template Name:** Restaurantly
*   **Author:** BootstrapMade.com
*   **Template URL:** [https://bootstrapmade.com/restaurantly-restaurant-template/](https://bootstrapmade.com/restaurantly-restaurant-template/)
*   **License:** Information regarding the template's license can be found at [https://bootstrapmade.com/license/](https://bootstrapmade.com/license/).
*   **Note on Forms:** As mentioned in `forms/Readme.txt`, a "fully working PHP/AJAX contact form script is available in the pro version of the template." The current forms save data to JSON files.

## Potential Improvements & Notes

*   **Security:**
    *   **Admin Credentials:** The method for setting and managing admin credentials for `admin/login.php` should be clearly defined and secured. Avoid hardcoding credentials.
    *   **Input Sanitization & Validation:** While some basic handling is present (e.g., `htmlspecialchars`), ensure all user inputs (forms, URL parameters) are thoroughly sanitized and validated to prevent XSS, injection attacks, and other vulnerabilities.
    *   **File Permissions:** Restrict file permissions as much as possible. The `data/` directory needs to be writable, but other files should have stricter permissions.
    *   **Error Reporting:** Disable detailed PHP error reporting on a production server to avoid leaking sensitive information.
*   **Data Management:**
    *   **Database Migration:** For enhanced scalability, data integrity, and querying capabilities, consider migrating from JSON files to a relational database (e.g., MySQL, PostgreSQL). The existing `admin/config.php` suggests this was a potential plan.
    *   **Backup Strategy:** Implement a backup strategy for the `data/` directory if continuing with JSON file storage.
*   **Admin Panel Enhancements:**
    *   **Edit Functionality:** Currently, the admin panel primarily supports adding/deleting news and viewing reservations. Adding functionality to edit existing reservations or news items would be beneficial.
    *   **User Management:** If multiple admin users are needed, a proper user management system would be required.
*   **Form Handling:**
    *   **AJAX Submission:** For a smoother user experience, implement AJAX form submissions to avoid page reloads. The "pro version" of the template likely offers this.
    *   **Email Notifications:** Add email notifications to administrators upon new reservations or contact form submissions.
*   **Code Quality:**
    *   **Consistency:** Ensure consistent coding style and practices across all PHP files.
    *   **Comments:** Add more comments to explain complex logic within PHP scripts.
*   **Dependencies:**
    *   Consider using a dependency manager like Composer for PHP packages if the project grows or requires external PHP libraries.
