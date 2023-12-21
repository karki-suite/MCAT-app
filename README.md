# Karki Suite

# Deployment

Deploys are managed through Cloudways.

1. Log into Cloudways and "Deploy with Git".
2. SSH into the server, navigate to public_html.
3. Build updated CSS - `npm run build`
4. Run Laravel Migrations `php artisan migrate`

# application_schedule.yaml

Located at `config/application_schedule.yaml`.

Changes to application_schedule.yaml can be deployed via Cloudways by clicking the green "PULL" button on this page: https://platform.cloudways.com/apps/4034683/deployment

Note that while config changes can be deployed without further action, changes to styling or database configuration may require additional steps.

## Text Formatting in YAML
In general, text should be wrapped in single quotes.

E.g. 'some text'

You can skip quotes in specific circumstances (e.g. alphabetical characters only, no spaces), but it is safer to default to always using quotes if unsure.

## Top Level
The top level always starts with the following...  This represents the title, and all "sections" within. Think of sections as the cards you see.
```
US:
  -
    title: 'The Unscored Sample Exam'
    sections:
```
## Sections
Sections can be any of the following "fixed blocks"... These are blocks that aren't customizable and have complex functionality.
```
      - COMMON_ERROR_TYPES
      - WEAKEST_CATEGORIES
```

They can also have "custom sections". These are the blocks that contain configurable content.
```
      -
        title: UWorld
        content:
```

## Content
Content is line items within a section/card. Sections look like this:
```
          -
            type: subtitle
            text: 'Application (20 Questions Each)'
```

Type can be one of the following values:
- subtitle (bolded and centered subtitle)
- checkbox (with a checkbox)
- percentage (with a percentage field)

Text can be either any text of your choosing, or exactly this format:
```
WEAKEST_CATEGORIES:TEST_CODE:INDEX:REFERENCE
```
Replace TEST_CODE and INDEX. When Index exceeds the number of available weakest categories it will loop back around.

Example:
```
WEAKEST_CATEGORIES:US:23:REFERENCE
```

Adding a link: You can also add a `link` property to any checkbox or percentage type.
e.g.
```
          -
            type: checkbox
            text: 'Cascade Mapping for BB (Optional)'
            link: 'https://www.youtube.com/watch?v=D6kDizCYfBk'
```
