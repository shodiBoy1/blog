---
date: 2024-10-17
tags: #php, #blog
---

# Creating My PHP Blog: Step-by-Step Guide

## Table of Contents
- [Overview](#overview)
- [Day 1: Project Setup](#day-1-project-setup)
    - [Step 1: Initial Setup](#step-1-initial-setup)
    - [Step 2: Initialize Git Repository](#step-2-initialize-git-repository)
    - [Step 3: Let's Go with Coding](#step-3-lets-go-with-coding)

## Overview

This guide documents the creation of my PHP blog over two days, detailing each step of the process.

## Day 1: Project Setup

### Step 1: Initial Setup
1. **Create a New Directory**:
    - Create a folder for your project and name it as you wish `blog_project`(example):
    - Run the command in your terminal:
   ```bash
   mkdir blog_project
   cd blog_project
   ```
   - Inside the `blog_project` folder create subdirectories to organize your code:
   ```bash
   mkdir .docker
   touch .docker/Dockerfile
   touch docker-compose.yml
   mkdir assets
   mkdir assets/css
   mkdir assets/images
   mkdir assets/js
   touch assets/css/style.css
   touch assets/js/main.js
   mkdir src
   cd src
   touch index.php
   touch about.php
   touch blog.php
   touch send_emails.php
   touch subscribe.php
   touch unsubscribe.php
   touch subscribers.txt
   mkdir md
   mkdir templates
   touch templates/header.php
   touch templates/footer.php
   ```
   - `.docker` folder will contain your Dockerfile
   - `docker-compose.yml` will define your Docker containers
   - `assets` folder fill contain your css, js file and images folder
   - `src` folder will contain all your PHP code and HTML files
   - `index.php` will have your main page code(what user will see when he goes to your website)
   - `about.php` will have your code for about page 
   - `blog.php` will have your code for displaying of your post cards and your post markdown textes
   - `send_emails.php` will contain your email sending code
   - `subscribe.php && unsubscribe.php` will handle your subscribe and unsubscribe functionality
   - `subscribers.txt` will contain emails of your subscribers for weekly or bi-weekly emailing
   - `src/md` will contain your posts markdown texts
   - `templates` will contain your header and footer file that you can include in all your pages


### Step 2: Initialize Git Repository

#### 2.1 **Initialize Git in Your Project Directory**:
- Open your terminal and navigate to your project directory.
   - Run the command:
     ```bash
     git init
     ```

#### 2.2 **Add the GitHub Repository as a Remote**:
- You need to add the GitHub repository URL as the remote origin. Make sure to replace `youraccount` and `yourrepository` with your actual GitHub username and repository name:
   - Run the command:
     ```bash
     git remote add origin https://github.com/youraccount/yourrepository.git
     ```

#### 2.3 **Add Your Project Files to Git**:
- Add all your project files to Git’s staging area by running the following command:
  - Run the command:
    ```bash
    git add .
     ```
#### 2.4 **Commit Your Changes**:
- Create an initial commit with a message:
 - Run the command:
   ```bash
   git commit -m "First commit"
   ```
#### 2.5 **Push Your Code to GitHub**:
- Push your local project to the main branch of your GitHub repository:
  - Run the command:
     ```bash
     git push -u origin main
     ```
- If GitHub asks for authentification, provide your GitHub username and personal access token(password).
- Now your project is connected to the repository, and the code is pushed to GitHub!

### Step 3: Lets go with Coding 

#### 3.1 **Dockerfile**:
- Open your Dockerfile in .docker folder and write this code:
  ![My Image](/assets/images/dockerfile.png)

-  [**Click here to read the full explanation of the Dockerfile code**](/blog/Dockerfile).
 

#### 3.2 **docker-compose.yml**:
- Open your docker-compose.yml file
  ![My Image](/assets/images/docker-compose.png)

-  [**Click here to read the full explanation of the docker-compose code**](/blog/docker-compose).

#### 3.3 **Start the docker**:

- Open your terminal in PHPStorm or VSCode
- Run the command:

  ```bash
  docker-compose build
  docker-compose up -d
  ```
  After running these commands, you should see your Docker containers up and running.
  ![My Image](/assets/images/docker.png)
  If everything looks good, congratulations—you've successfully created your Docker containers!
- Next, create an index.php file in your src folder and add the following simple code:

  echo "If the page is working i should see thix text on my screen!";

- Now, when you visit your localhost in your browser, you should see this message displayed on the screen.

#### 3.4 **Header && Footer**:

- Open your header.php file and add this code into your file:
  ![My Image](/assets/images/header.png)

- Open your footer.php file and add this code into your file:
  ![My Image](/assets/images/footer.png)

#### 3.5 **Main Page**:

- Open your index.php file and write this code:
  ![My Image](/assets/images/index.png)
- dont forget to include your profile pic!

 **Go to the SECOND PART and follow next steps**:

-  [**Click here to read the full explanation of the docker-compose code**](/blog/how_i_created_this_blog_PART_II).





  
  
   






