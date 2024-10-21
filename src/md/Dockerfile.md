---
date: 2024-10-20
tags: #docker, #blog
---

####  **Dockerfile**:
![My Image](/assets/images/dockerfile.png)

- What it does:
- Think of it as creating a kitchen where you can cook food(run your PHP application).

**FROM php:8.0-apache**
- What it does:
  Think of this like picking the base kitchen where you're going to cook. You're choosing a kitchen that already has an oven(Apache) and all the tools needed to cook PHP meals(PHP 8.0).
- Why:
  You dont want to build a kitchen from scratch every time. This gives you a ready-to-use kitchen with PHP and Apache.

**RUN apt-get update && apt-get install -y \ git \ unzip \ zip \ libzip-dev \ && docker-php-ext-install mysqli zip \ && a2enmod rewrite \ && rm -rf /var/lib/apt/lists/**
- What it does:
  This is like stocking up your kitchen with ingredients and appliances you'll need:

**git**: A tool to grab recipes (code) from a friend's kitchen (GitHub).
**unzip, zip, libzip-dev**: These are your basic tools to open packages (compressed files).
**mysqli**: An ingredient that lets you cook using MySQL databases(works with databases).
**a2enmod rewrite**: Enables a special tool in your oven (Apache) so you can cook custom meals (create cleaner URLs in your app).
- Why:
  Just like you need basic ingredients in your kitchen (flour, sugar), you need these to make your PHP app run correctly.

**COPY --from=composer:latest /usr/bin/composer /usr/bin/composer**
- What it does:   
  Imagine this like borrowing a magic cookbook (Composer) that helps you automatically gather all the secret ingredients (libraries) your meal (application) needs.
- Why:
  Composer helps you easily get the extra tools and libraries your app needs, so you don’t have to manually hunt them down.

**WORKDIR /var/www/html**

- What it does:
  Sets the kitchen counter (working directory) where you will do your cooking. Here, /var/www/html is the main folder where your app’s files will be stored and served.
- Why:
  It’s like telling everyone where the action is happening in the kitchen — where you’ll be preparing your dishes (running your code).

**RUN composer require erusev/parsedown**

- What it does:
  This command uses that magic cookbook (Composer) to download and set up Parsedown, a tool that lets you easily cook Markdown into HTML (convert text files into web pages).
- Why:
  You need Parsedown to help with your Markdown files (like recipe instructions) and turn them into something the web can display.

**CMD ["apache2-foreground"]**

- What it does:
  This is like telling your kitchen staff (Apache) to keep the oven (web server) running in the foreground, making sure it’s ready to serve dishes (webpages) whenever someone orders them (visits your site).
- Why:
  Without this, your oven wouldn’t stay on and no one would be able to get their food (visit your site).

**In Summary**

- You're building a kitchen (PHP + Apache) ready to cook.
- You're stocking it with tools like git, mysqli, and more to help cook your PHP app.
- You're using Composer to gather extra ingredients (Parsedown) automatically.
- Finally, you're telling the oven (Apache) to stay on, ready to serve food (your app) to anyone who visits.