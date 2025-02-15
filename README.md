# Mini CRM

## Setup Instructions
1. Clone the repository and navigate to the project directory.
2. Run the following commands:
   ```bash
   php artisan migrate
   php artisan db:seed

## Project Details
This project is built using **Laravel** with the **Sneat Dashboard** theme.  
It includes **Spatie Permissions** for role management.  
The **employees table** is intentionally used, even though Spatie allows assigning roles to users directly.

## Why Use an Employees Table?
While Spatie permissions allow for **role-based access control**, I chose to keep a separate **employees table** because:

- A **CRM system** typically involves different user types such as **Admins, Employees, and Moderators**.
- This structure allows for **future scalability**, enabling employee-specific attributes like:
    - **Department**
    - **Salary**
    - **Work Status**
    - **Other employee-related details**

By separating employees into their own table, the system remains **more structured and adaptable** for future expansions.
