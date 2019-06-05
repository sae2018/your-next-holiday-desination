# Stephen Elcombe - Interactive Frontend Development Milestone Project - Create a single page application that relies heavily on one or more APIs

This project is to create the Your Next Holiday Destination website to find activities, accommodation, restaurants etc. in both your local area and by any city in the world you specify. It fulfils the needs stated in the client's brief that you can:
1) Select a destination city
2) Find tourist attractions
3) Find accommodation
4) Find bars and restaurants

 
## UX
 
I designed this website to make it easy and intuitive for anyone to access the latest content based on their local or worldwide search. Users want to see the results in an easy to read format and I have made this display as easy as possible in an understandable way within the same page. My original wireframe is available at https://your-next-holiday-destination-sae2018.c9users.io/assets/img/wireframe.png.

- As a holidaymaker, I want to view a list of hotels in the area I'd like to stay in, so that I choose somewhere to stay for my holiday.
- As a holidaymaker, I want to view a list of the local parks, so that I can take the children for walks in the area we're staying in.
- As a parent, I want to find the amusement parks around where I live, so that I can take my children on a day out there.
- As a friend, I want to book a table at a restaurant, so that my friends and I can go out for a meal together.
- As a friend, I want to find a local pub to where I am to go to after the restaurant to socialise with my friends.


## Features

Forms - The left had side of the design is designed to obtaining the information needed to query Google API with activity/company type and the city.
Map - The right hand side of the design is designed to display the map with pin locations for all the results found of the activity/company type in and around that city, with the detailed listings relating to each pin under the map.

 
### Existing Features
- Forms allowing the collection of the information needed to query the Google API
- Map displaying the pins relating to the chosen activity/company type in the chosen city
- Detailed results listing more in depth information relating to the pins on the map


### Features Left to Implement
Future features that could be added include:
- Linking phone numbers to Skype or VOIP services to call the companies from your computer
- Linking URLs to website addresses, currently displayed as plain text
- Monitization from either banner ads or affiliate links in the results


## Technologies Used

The website makes use of:
- [HTML5](https://www.w3.org)
    - This project uses **HTML5** as the base code.
- [CSS3](https://www.w3.org)
    - This project uses **CSS3** to style the page layout.
- [Bootstrap](https://getbootstrap.com)
    - This project uses **Bootstrap** to structure the page layout.
- [Cloud9](https://ide.c9.io)
    - This project uses **Cloud9** to edit and host the files and code.
- [Git](https://git-scm.com/)
    - This project uses **Git** for version control.
- [GitHub](https://github.com)
    - This project uses **GitHub** for version publishing.

I have also used the following websites as references for code or content:
- [W3 Schools](www.w3schools.com)
    - This project used **W3 Schools** to reference semantic code.
- [BootstrapMade](www.bootstrapmade.com)
    - This project used **BootstrapMade** to get the basic layout template.
- [StackOverflow](www.stackoverflow.com)
    - This project used **StackOverflow** for information about how to post form data back to the same page using PHP.


## Testing

I have been through the whole site and tested every link on every page to ensure they all work as expected.

To test my site's validity I used:
- [HTML5](https://validator.w3.org/nu/)
- [CSS3](https://jigsaw.w3.org/css-validator/)

For any scenarios that have not been automated, test the user stories manually and provide as much detail as is relevant. A particularly useful form for describing your testing process is via scenarios, such as:

1. Contact form:
    1. Go to the "Bookings" page
    2. Try to submit the empty form and verify that an error message about the required fields appears
    3. Try to submit the form with an invalid email address and verify that a relevant error message appears
    4. Please note: The form on this page will not submit, as we have not yet been taught how to do that

2. Photos:
    1. Go to the "Photos and Videos" page
    2. Left click on one of the thumbnail photos or the photo name and verify that the photo loads full-size into a new browser window
    3. Right click on the image to confirm that you can copy or save the photo

3. Videos:
    1. Go to the "Photos and Videos" page
    2. Confirm that the video plays automatically (in some browsers) or click the play button to start it
    3. Left click on the three dots to confirm that the video can be downloaded

4. Songs:
    1. Go to the "Songs" page
    2. Left click play on one of the audio file sliders and verify that the music starts
    3. Left click on the song name to verify that the audio clip can be loaded into a new tab
    4. Left click on the three dots to confirm that the audio file can be downloaded


The website has been tested with all the major browsers and remains stable on all versions in all sizes. In order for this to happen I have used semantic structured code and utilised the browser specific CSS3 code for transitions on the transitions.

There were some issues with the code on some of the pages during creation and testing, such as not stacking properly in different screen sizes and transitions not working as expected, but these problems have been solved with a little research beyond what we have been taught so far.


## Deployment

Differences between the deployed version and the development version:
- The version of the website held on C9 (development version) is identical to the GitHub (deployed version)
- All files are identical on both servers, apart from wireframe.png, which is only on C9 and not GitHub
- All GitHub files are stored under the master branch


## Credits
Thanks for their help when I got stuck go to the Code Institute Tutor Team and to my mentor who went through my work before submission. I would also like to thank the websites whose resources I used both when I was stuck and for website functionality, as listed in the [## Technologies Used](#technologies-used) section above.

### Content
- The 'About Us' text for the footer was copied from the [Wikipedia article The Monkees](https://en.wikipedia.org/wiki/The_Monkees)


### Media
- The photos, videos and audio used in this site were obtained from the resources section for the project. In order to use the images of new material on the homepage I sought permission from The Monkees official website, but as at today 11/10/18 I have not yet heard whether I have permission to use these images or not, and therefore have a placeholder image to show where they would go.


### Acknowledgements

- I received inspiration for this project from previous project work taught on the course.
