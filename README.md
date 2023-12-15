# CustomInvoiceComment

To show the customer's comment on the invoice in Shopware 6, follow these steps:

1. Install the "CustomInvoiceComment" plugin.
2. Add the following variable in the "invoice.html.twig" file:
   ```twig
   {{ order.customerComment|sw_sanitize|nl2br }}
