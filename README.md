# Category Url Path Generator

Magento 2 plugin for remove parent category from subcategory URLs.

## Configuration

Navigate to *Stores > Configuration > General > Catalog > Catalog > Search Engine Optimization > Use Parent Category Path for Category URLs*

## Reset url_path for existing categories
Run the below command in command line to reset the category path (excluding parent categories)

php bin/magento sellerdeck:category:updateurl

Then any url re-write generator could be used to re-generate url-rewrites for categories 
