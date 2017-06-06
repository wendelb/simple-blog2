{include 'header.tpl'}
    <div class="content">
    {foreach $articles as $item}
        <div class="blog-entry">
            <a href="/?page=detail&id={$item.id}">
            	<h2 class="blog-header">
            		{$item.created}: {$item.title|escape:'html'} ({$item.comment_count} Kommentar{if $item.comment_count != 1}e{/if})
            	</h2>
            </a>
            <div class="blog-content">{$item.content}{if $item.there_is_more} <a href="/?page=detail&id={$item.id}">[lesen]</a>{/if}</div>
            <div class="blog-author">Autor: <a href="/?page=author&author={$item.author_id}">{$item.author_name|escape:'html'}</a></div>
        </div>
    {/foreach}
    </div>

    {if $pagination.has_more}
    <div class="pagination">
        <a href="{$pagination.next_link}">N&auml;chste Seite</a>
    </div>
    {/if}
{include 'footer.tpl'}