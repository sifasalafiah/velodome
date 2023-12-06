# Velodome Package Installation Guide

1. Start by installing the package through Composer: `composer require velodome/velodome`.
2. Next, in `bootstrap/app.php`, register the service provider: `$app->register(Velodome\Velodome\VelodomeServiceProvider::class);` and `$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);`
3. Generate autoload files by executing: `composer dump-autoload`.
4. Ensure the following environment variables are added:
   - `OPEN_AI_URL=https://api.openai.com/v1/chat/completions`
   - `OPEN_AI_TOKEN=Your OpenAI Token`
   - `OPEN_AI_PROMPT="Examine the image and specify the database object properties required for that item. Offer the details in this format: property_1:data_type, property_2:data_type, ..., property_n:data_type. Please remember to stick to the format: property_1:data_type, property_2:data_type, ..., property_n:data_type, using data types from the list: string, integer, bigInteger, float, double, decimal, boolean, date, time, dateTime, text, longText, binary, json."`

## Usage

To make use of this package, adhere to these steps:
1. Go to the URL `localhost/velodome/api-generator`.
2. Utilize the tools available to explore functionalities.

## Configuration

_[Include any pertinent configuration details here]_

## Contributing

We highly encourage contributions! Please refer to our contribution guidelines.

## License

This package is open-source and is licensed under the MIT License.
