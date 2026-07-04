# Automated Software Development & Deployment Process (CI/CD Pipeline)


---

##  Project Overview & Problem Statement
The primary purpose of this project is to automate the software development lifecycle (SDLC) by building a comprehensive automated development and deployment process. The pipeline covers everything from code modification by the developer to remote repository hosting, continuous integration via Jenkins, and containerized delivery using Docker.

---

##  System Architecture & Components
As requested in the project guidelines, the architecture implements a full automation loop consisting of the following key stages:

1. **Application Server & Environment:** A virtual environment/server configured with a LAMP stack (Apache, PHP 8.2, and MySQL Database) to host and serve the application.
2. **Client Machine Connection:** Remote administration and control established between the client machine and the application server securely via **SSH protocol**.
3. **The Web Application (Simple Dictionary):** A database-driven web application built with PHP. When a user inputs an English word, the application queries the database and successfully returns the proper Arabic meaning.
4. **Source Code Management (SCM):** The source code is hosted on a remote **GitHub** repository (`dictionarydevops`) for team collaboration and version control.
5. **Continuous Integration & Deployment (CI/CD):** A automated **Jenkins** job that continuously pulls the latest code modifications from GitHub, builds it, and triggers the automated deployment script.
6. **Containerization:** The application is packaged and running inside a lightweight, isolated **Docker Container** mapped to port `8081`.

---

##  Repository Files Structure

- **`index.php`**: The web application frontend and core logic for querying the dictionary.
- **`Dockerfile`**: Defines the environmental recipe (PHP 8.2 + Apache + `mysqli` driver installation) to build the container.
- **`deploy.sh`**: The master automation script executed by Jenkins to automate tasks 4-6 seamlessly.
- **`database.sql`**: The database schema dump containing the `words` table with sample dictionary data (e.g., apple, book, computer, server) and their translations.

---

##  Step-by-Step Automation Workflow (Task Flow)

When the code is modified, the automated script (`deploy.sh`) performs the following sequence:
1. **Cleanup Stage:** Stops and removes any previously running container instance (`my-dictionary-container`) to free up network resources.
2. **Dynamic Host Configuration:** Automatically updates the application's database connection string using `sed` to dynamically route requests via the Docker network gateway (`172.17.0.1`) instead of the default `localhost`.
3. **Environment Build:** Compiles a fresh Docker image based on the specifications detailed in the `Dockerfile`.
4. **Automated Deployment:** Spawns a brand new container running the updated version of the dictionary application with zero manual intervention.
