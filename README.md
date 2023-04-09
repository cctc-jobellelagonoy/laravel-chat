<!-- GETTING STARTED -->
## ChatGPT-powered Conversational Assistant
## Prerequisites

You will need PHP, Composer and Node.js. For MacOS I recommend installing them with [Homebrew](https://brew.sh/). For Windows see instructions for [PHP](https://windows.php.net/download/), [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows) and [Node](https://nodejs.org/en/download/).

## Installation

1. Get your free Pusher API Keys at [https://pusher.com](https://pusher.com) and [https://platform.openai.com](https://platform.openai.com/account/api-keys)
2. Clone this repo
   ```sh
   git clone https://github.com/nymeria-1/laravel-chat.git
   ```
3. Install Composer packages
   ```sh
   composer update --ignore-platform-reqs
   ```

4. Install NPM packages
   ```sh
   npm install
   ```
5. Create a mysql database file in the database folder, and update database name in .env 
6. Enter your API keys in `.env`
   ```
    OPENAI_API_KEY=
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=
   ```
7. Initilise the database
    ```sh
    php artisan migrate
    ```
8. Compile the webpages and run it
    ```sh
    npm run dev
    php artisan serve
    ```


