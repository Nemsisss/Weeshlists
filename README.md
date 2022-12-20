# Weeshlists

https://weeshlists.herokuapp.com/

Topic and purpose of my webapp :

Topic of my site is an app where the user can have all of their favorite/wishlist items in one place, so it’s basically one big Wishlist. It allows the user to manually insert different favorite items from different websites into this app, store them in it and access/update/delete them.
Instructions on how my website works:

• In order to use the website, the user has to either login (if they have an account) or sign up (if they don’t have an account).

• In case where a user is not logged in, the only pages that they can access is the landing page, sign in and signup pages. Even if the user tries to manipulate the url in order to navigate to for example home.php page, they won’t be able to if they’re not logged in, they’ll just be redirected to the landing page.

• After logging in, the user is taken to the home page. There’s a search bar in the home page where users can search for items by entering a keyword. However, the default homepage that they see is just a few recommendations which is loaded from the API as soon as the user enters the homepage.
 
  - The user can click on “Visit” button for any of the items loaded on the homepage which will take them to the URL of that item and they can learn more       about the item. If they are interested in it, they can manually add it to the list of their Wishlist items in the app.
 
  - Since it’s only for recommendation purposes, only 12 items are loaded per every search (including the default where the keyword is set to “lamps”).
 
  - the API is a bit slow, so give it a few seconds to update after every search.

• In the navbar, there are options to add an item to wishlist and view the wishlist items. 
  
   -  For viewing the wishlists, on the view.php page the user can either click on
  search and it will just display all of their wishlist items, or they can filter by using
  keywords, and/or choosing a category.
  
    - Once they click on search, they will be taken to the view_results page which
      shows their items. NOTE: If the user is new and has just registered, they don’t have any wishlist items yet, so the page will say “No items found”         until they add at least one item to their list.
  
    - The view_results page shows 12 items per page. They can click on next/prev/first/last buttons on the bottom of the page to navigate through pages.
  
    - Once they see the items, they have the option to edit or delete them.
  
    - For adding or editing an item, three things are required to be provided to the
      app: 1- item name 2- item url 3- category

• Whenever user is done using the app, they can logout by clicking on “logout” on the
navbar.
