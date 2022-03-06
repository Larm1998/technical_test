You've made it this far! But this is your next challenge!

## The Problem
Frumbledingle Corp is struggling with its warehouse management, and has been looking for a developer to help. You need to create a small management app for their inventory. Part of this has been done for you by the last developer they hired - it's your job to finish it. This will consist of the following:

### Data Operations
- Create/Read/Delete operations for all different models
- RESTful API routes for these operations
- Setting up relations between models

  **Results:**
  
  **Category Controller:**
  
  ![image](https://user-images.githubusercontent.com/36891937/156936534-ca4f0031-40ae-4d44-919f-0f9096fa6e35.png)
  
  **Item Controller:**
  
  ![image](https://user-images.githubusercontent.com/36891937/156936558-d8d8052c-aa89-486d-b72b-636e7809bcb5.png)
  
  **Location Controller:**

  ![image](https://user-images.githubusercontent.com/36891937/156936578-e47a2852-6028-4b12-b674-d8771082b362.png)
  
  **Report Controller:**

  ![image](https://user-images.githubusercontent.com/36891937/156936598-7921ed7b-e2c5-4bd0-bd3d-325ddf7ec71a.png)

### Frontend Operations
- Set up VueJs components for the various pages (one of these has been done for you)
- The *categories* page **MUST** include the name of the relevant parent *category* in the table for each *category*, if there is one.
- The *items* page **MUST** include the name of the relevant *location* and *category* in the table for each *item*.
- The navigation links will tell you what pages need to work
- Use *axios* (included) to retrieve data via AJAX

  **Results:**
  
  **Location Screen:**

  ![image](https://user-images.githubusercontent.com/36891937/156936638-f830a57f-7ece-45e6-a1bc-d849684ee886.png)
  
  **Items Screen:**

  ![image](https://user-images.githubusercontent.com/36891937/156936657-a87641ca-6f41-4c5f-9947-e1d8743b2874.png)
  
  **Categories Screen:**
  
  ![image](https://user-images.githubusercontent.com/36891937/156936676-8173a4e8-7832-4285-9269-88e98b7e75d0.png)



### Other Considerations
- You do not need to include User Authentication in this application
- We should be able to *git clone* your project and run it; you must provide any additional instructions needed
- Any other **cool stuff** you want to add after completing the requirements here will be taken into consideration.

## Setup Instructions
- REQUIRED: `php`, `git`, `composer`, `postgresql`, `node`, `npm`
- `git clone` this repo
- Run `composer install`
- Make sure to set the database information your `.env` file
- Run `php artisan migrate`
- Host the app however you'd prefer, but use `npm run dev` or `npm run watch` to compile the Vue components

## The Data
The data for this application will be defined as below. Migrations have already been created to set up the tables for this data, but no data has been inserted. You will need to create your own database for this test.

### Locations
- Columns: ID, Name
- A *location* has many *items*

### Items
- Columns: ID, Name, Category ID, Location ID
- An *item* belongs to a *location* and a *category*

### Categories
- Columns: ID, Name, Parent ID
- A *category* has many *items*
- A *category* belongs to a parent *category*, though the parent may be null

## The Final Battle
After making the pages for individual models work, you will need to create a report page. This page must include a price input, and should give a list of all categories for each location (including the parent category name), and the number of items greater or equal to that price in that category/location pairing.

Example:

|Location|Parent Category|Category|Count|
|--|--|--|--|
|Frumbledingle Corp| |Widgets|1|
|Frumbledingle Corp|Cars|Chevrolet|2|
|Frumbledingle Corp|Cars|Nissan|3|
|Plupbuckle, Inc.| |Widgets|1|
|Plupbuckle, Inc.|Cars|Chevrolet|1|
|Plupbuckle, Inc.|Cars|Nissan|2|
|Plupbuckle, Inc.|Purses|Louis Vuitton|1|

**Final Result:**

![image](https://user-images.githubusercontent.com/36891937/156936707-96bbd375-320b-4639-84bd-2edc48a4a466.png)


