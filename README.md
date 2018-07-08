# Recipes CPT #
A simple plugin to allow publishers to create Recipes custom post types.

## Description
This plugin registers a custom post type called Recipes with support for
* Title
* WYWISYG editor
* Category
* Ingredients

It exposes the Recipes post type through two custom REST API endpoints
* `/wp-json/v1/recipes` - returns all the available recipes.
The number of results to return can be changed using the `num_results` parameter (defaults to 4),
e.g.: `/wp-json/v1/recipes?num_results=8`

* `/wp-json/v1/recipes/<id>` - returns the recipe with a specific ID.

The response includes the `title`, the `content`, the `ingredients` and the `permalink`.

## Installation
1. Upload the "recipes-cpt" folder into the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress

## Consume the Recipes post type using JavaScript ###
```javascript
const fetchRecipes = async (url) => {
    try {
        const response = await fetch(url);
        const jsonResponse = await response.json();
        return jsonResponse.recipes;
    } catch(err) {
        console.log(err);
    }
}

fetchRecipes('https://mywebsite.dev/wp-json/v1/recipes').then(data => {
    // extract and use the recipes data
});
```
