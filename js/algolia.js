const indexname = drupalSettings.algolia.config.indexname;
const appId = drupalSettings.algolia.config.appId;
const apiKey = drupalSettings.algolia.config.apiKey;

if (indexname && appId && apiKey) {
  const search = instantsearch({
    indexName: indexname,
    searchClient: algoliasearch(appId, apiKey),
  });

  search.addWidgets([
    instantsearch.widgets.searchBox({
      container: "#searchbox",
    }),
    instantsearch.widgets.hits({
      container: "#hits",
      templates: {
        item: `
      	<h3 class="title">{{{_highlightResult.title.value}}}</h3>
      	<p class="body">{{{_highlightResult.body.value}}}</p>
        <span class="brand"> <b>Brand Content:</b> {{{field_brand_content}}}</span>
      	`,
      },
    }),
  ]);
  search.start();
} else {
  throw "Algolia settings missing";
}
