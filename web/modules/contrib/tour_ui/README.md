// @phpcs:ignoreFile

# Tour UI

## Synopsis

Tour UI module provides a user interface for [Tour module](https://www.drupal.org/docs/8/core/modules/tour/overview) in Drupal 8 core. The Tour API documentation provides information on how to create a tour, while Tour UI provides a user interface for doing so.

*Note:* When you find a bug it could also be a [Drupal core Tour issue](https://www.drupal.org/project/issues/drupal?text=&status=Open&priorities=All&categories=All&version=8.x&component=tour.module).

## Requirements

- Users must be given 'Administer tour' permission in order to create, edit and delete tours.

## Dependencies

- [Tour (core)](https://www.drupal.org/docs/8/core/modules/tour/overview)

## Getting Started

1. Install Tour UI module (`composer require drupal/tour_ui`)
2. Enable Tour UI module (this will also enable core Tour module if not already enabled)
3. Set permissions for 'Administer tours' and 'Access tours' at /admin/people/permissions
4. Add and configure tours at /admin/config/user-interface/tour
5. To configure a tour, give it a **Tour Name** and enter the **Module Name**. This controls where the exported configuration is stored if you are using Configuration Management. If you're not using Configuration Management, you can just enter tour_ui. If you are using Configuration Management, you should create a custom module and enter its name in this field.
6. In the **Routes** field, enter the route of each page on which you want your tour to be available, one route per line. See "Determining Routes for Your Tours" section below for instructions.
7. Create any number of steps for your tour by selecting **Select a new tip>Text** and clicking on **Add**.
8. For each step, enter a **Label** and the **Body** text.
9. Next, add the **Selector** to attch the tip to. This can be any selector string or a DOM element (e.g,. .some .selector-path or #some-id).  If you don’t specify the element will appear in the middle of the screen.
10. Finally, set **Position** to determine the position of the tour dialog relative to the id or class you entered above (e.g,. top, bottom, left, right).
11. **Save** changes and repeat, creating as many steps as necessary.
12. The order of the steps can be changed using the drag and drop feature on the tour edit page.
13. Once order is set, **Save** your tour.
14. Visit the page your tour is configured to run on and a **Tour** button in the upper right-hand corner of the screen should appear. Clicking this button starts the tour.

## Determining Routes for Your Tours

Two methods for finding the route of a page:

### Method 1: Find Route Using the Devel Module

1. Install and enable the Devel module.
2. Rebuild Drupal caches.
3. Go to /devel/routes where you will see a list of routes. There you can search and find the specific one you are looking to target.

### Method 2: Find Route Using Theme Function and Variable

1. In your theme's .theme file, add a hook_preprocess_page function like the example below replacing the mytheme with your theme's machine name:
    ```
    /**
     * Implements hook_preprocess_page().
     *
     */
    function mytheme_preprocess_page(&$variables) {
      $variables['route_name'] = \Drupal::routeMatch()->getRouteName();
    }
    ```
2. In your theme's page.html.twig template, add the following code:
    ```
    {{ route_name }}
    ```
3. Rebuild Drupal caches.
4. Visit the page you are looking to target and you should see a route printed on the page: an example would be view.news.page_1 or entity.node.canonical.
5. **Remember to remove the code above before committing your work!**

### Other Resources and Documentation

- [Overview of Tours](https://www.drupal.org/docs/develop/user-interface-standards/tours): use cases and general information.
- [Tour Text Standards](https://www.drupal.org/docs/develop/user-interface-standards/tour-text-standards): style guidance for tour content.
- [Tour Module Part 2](https://www.previousnext.com.au/blog/tour-module-part-2-creating-tour-your-module): Creating a Tour for your module (PreviousNext)
- [Set up a guided tour on Drupal 8](https://www.flocondetoile.fr/blog/set-guided-tour-drupal-8) (Flocon de toile)
