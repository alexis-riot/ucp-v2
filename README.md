## Disclaimer 
 
Welcome to the Mafia City Roleplay development area. By accessing this area, you agree to the following: 
 - You will never give the script or associated files to anybody who is not on the Mafia City Roleplay Non-Disclosure Agreement. 
 - You will delete all development materials (script, databases, associated files, etc.) when you leave the Mafia City Roleplay development team. 
 - You will notify the Lead Developer if you notice any security flaws, backdoors, or possible bugs. 
 
## Developments informations

#### Installation on dev environment:
- Clone the project: ```git clone git@gitlab.com:mcrp/ucp-v2.git```
- Install laravel dependencies: ```composer install```
- Install packages: ```npm install```
- Compile all assets: ```npm run dev```
- Create the configuration and edit them: ```cp .env.example .env && nano .env```
- Generate laravel key: ```php artisan key:generate```
- Make database migrations: ```php artisan migrate```
- Start the web server: ```php artisan serve```

#### Adding a plugin using npm:
```
npm install {module_name} --save
```

Save the module into `/node_modules/{module_name}`.
- To add it to each page of the website: `/resources/js/global.js`.  
Import the js/css file by using `require()`.  
`require("ion-rangeslider/css/ion.rangeSlider.css"); // include CSS`  
`require("ion-rangeslider/js/ion.rangeSlider"); // include JS`
- To add it for a single page on the website: `webpack.mix.js` and create a mix.  
Example: `mix.js('./node_modules/{module_name}/module.js', 'public/js');`


#### Adding a plugin without npm:
Download the plugin into `/resources/plugins/{module_name}`  
Go on: `webpack.mix.js` and create a mix.  
Example: `mix.js('./node_modules/{module_name}/module.js', 'public/js');`


#### Refresh the configuration:
- On production run:  `npm run production` (to minimify)
- On development run:
`npm run dev`

it make a generation of `/public/` and create all files mentionned in the `webpack.mix.js`
