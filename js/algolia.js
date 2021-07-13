/**  global javascript instantsearch algoliasearch */

const indexname = drupalSettings.algolia.config.indexname;
const appId = drupalSettings.algolia.config.appId;
const apiKey = drupalSettings.algolia.config.apiKey;

if(indexname && appId && apiKey){
  
  const search = instantsearch({
    indexName: indexname,
    searchClient: algoliasearch(appId, apiKey),
  });
  
  search.addWidgets([
    instantsearch.widgets.searchBox({
      container: '#searchbox',
    }),
    instantsearch.widgets.clearRefinements({
      container: '#clear-refinements',
    }),
    instantsearch.widgets.refinementList({
      container: '#brand-list',
      attribute: 'brand',
    }),
    instantsearch.widgets.hits({
      container: '#hits',
      templates: {
        item: `
          <div>
            <img src="{{image}}" align="left" alt="{{name}}" />
            <div class="hit-name">
              {{#helpers.highlight}}{ "attribute": "name" }{{/helpers.highlight}}
            </div>
            <div class="hit-description">
              {{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
            </div>
            <div class="hit-price">\${{price}}</div>
          </div>
        `,
      },
    }),
    instantsearch.widgets.pagination({
      container: '#pagination',
    }),
  ]);
  
  search.start();
}
else{
  throw "Algolia settings missing";
}
