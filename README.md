# Read Me

## Example template tag

```
{% set entry = entry is defined ? entry %}
{% set fallback = craft.globals.getSetByHandle('metaFallback') %}
{{ craft.simpleMeta.output(entry, fallback)|raw }}
```