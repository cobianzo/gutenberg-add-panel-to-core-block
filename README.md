# Add a custom panel to core block

Simple feature for gutenberg block.

Adds a panel with a command to an existing block. When this toggle command is pressed, it adds or remove a class to the `Advanced > Class` attribute of the block (`attributes.className`).

I tested and seems to be working pretty well.

Uses `@wordpress/scripts`, the js login is inside `js`

Setup for eslint and prettier, using wordpress packages and setup of `package.json` and .`eslintsrc`

To modify the project:

- go to folder `/js`
- `npm run start`
