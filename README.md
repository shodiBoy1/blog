# My PHP Blog Project

Welcome to my PHP-based blog project! This project is designed to showcase a simple, dynamic blog that uses PHP and Docker to manage the development environment. It features Markdown-based content for blog posts, a subscription system for users, and an "About Me" section.

## Features

- **Dynamic Blog Content**: The blog posts are written in Markdown and displayed using a Markdown parser, making content easy to write and manage.
- **Docker Setup**: The project is containerized with Docker to ensure a consistent development environment.
- **Subscription System**: Users can subscribe and unsubscribe to receive bi-weekly email updates.
- **About Me Section**: Includes a dynamically styled section with personal details and images.
- **Responsive Design**: The blog layout is built with a simple, responsive design using a grid system.

## Project Structure

Here's a quick look at the key directories and files:

- `src/`: Contains the PHP files for the blog, including:
  - `index.php`: Main entry point for the blog.
  - `blog.php`: Displays individual blog posts.
  - `about.php`: Displays the "About Me" section.
- `assets/`: Contains static files like CSS for styling and images.
- `docker-compose.yml`: Docker configuration file for setting up the environment.
- `subscribers.txt`: Stores email addresses for the subscription system.

## How to Run

To run this project locally, make sure you have Docker installed. Follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/shodiBoy1/blog
   ```
2. Navigate to the project directory:
   ```bahs
   cd your-repository
   ```
3. Start the Docker containers:
   ```bash
   docker-compose up
   ```
4. Access the blog in your browser at:
   http://localhost:8080

## Subscription System 
- Users can subscribe to receive email updates by submitting their email through the form on the blog.
- The system sends bi-weekly emails to subscribers with the latest blog posts.
- Subscriber information is stored securely in a subscribers.txt file.

## Contributing
Feel free to fork this repository and make your own changes. Contributions are welcome!

## License
This project is open-source and available under the MIT License.
