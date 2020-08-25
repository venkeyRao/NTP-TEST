  
Assumptions:

1. There are 2 user types in the application 
        a) NTP Admin - Resposible for Create, Update and Deleting Practitioner Profiles.
        b) Practitioner - This users profile gets created by NTP Admin user.

2. Requirement mentioned filter by category in practitioner profiles listing but category details are not provided, hence added 2 random categories ie category_one and category_two, users will be able to filter profiles on these 2 categories. 

Note: These assumptions could have been avaoided and I could have got the requiremnet updated in a real world scenerio.

Additional funcionalities that could have been added provided more time:

1. Forgot/Reset Passowrd functionality missing.
2. Welcome email notification to practitioner when his/her profile gets created.
3. User Profile Activation email to practitioner when his/her profile gets created (User would have to click on a link to get his profile activated).
4. Using local storage for saving files like profile images and gallery images. We should be using S3 or other cloud options since storing files where the code is hosted is not ideal. 
