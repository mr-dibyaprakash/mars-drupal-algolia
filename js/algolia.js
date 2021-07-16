/**  global javascript instantsearch algoliasearch */

const indexname = drupalSettings.algolia.config.indexname;
const appId = drupalSettings.algolia.config.appId;
const apiKey = drupalSettings.algolia.config.apiKey;
const template = drupalSettings.algolia.config.template;
const pagination = drupalSettings.algolia.config.pagination;

if(indexname && appId && apiKey && template){
  
  const search = instantsearch({
    indexName: indexname,
    searchClient: algoliasearch(appId, apiKey),
  });
  

  search.addWidgets([
    instantsearch.widgets.searchBox({
      container: '#searchbox',
    }),
    instantsearch.widgets.hits({
      container: '#hits',
      templates: {
        item: template,
      },
    }),
  ]);

  /**
   * check to enable pagination
   * pagination limit configurable on algolia account
   */
  if(pagination && pagination != 0){
    search.addWidgets([
      instantsearch.widgets.pagination({
        container: '#pagination',
      })
    ]);
  }
  search.start();

}else
{
  throw "Algolia settings missing";
}
