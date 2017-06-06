{include 'header.tpl'}
<div class="content">
    <div class="blog-header" data-id="{$article.id}">
        <h2>{$article.created}{if $loggedin} ({$article.ip}){/if}: {$article.title|escape:'html'}</h2>
        {if $EditOrDelete}<a href="/?page=newpage&id={$article.id}">Bearbeiten</a> <div class="delete-entry">löschen</div>{/if}
    </div>
    <div class="blog-author">Autor: {$article.fullName|escape:'html'}</div>
    <div class="blog-content">{$article.content}</div>
    <div class="comments">
        <div class="comment-count">{$comment_count} Kommentar{if $comment_count != 1}e{/if} vorhanden</div>
        <ol>
            {foreach $comments as $item}
                <li>
                    <b>{$item.name|escape:'html'}</b>
                    {if $item.url != ''}
                    <a href="{$item.url|escape:'html'}">{$item.url|escape:'html'}</a>
                    {/if}
                    meint ({$item.date}):
                    <br>{$item.comment|escape:'html'}
                </li>
            {/foreach}
        </ol>

        <div class="comment-new">Kommentar schreiben:</div>
        <form action="/" method="post">
        	<input type="hidden" name="page" value="detail" />
        	<input type="hidden" name="action" value="addComment" />
            {if $newComment.error != ''}<div class="new-comment-error">{$newComment.error}</div>{/if}
            <input type="hidden" name="article" value="{$article.id}" />
            <div>
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{$newComment.name}" required/>
            </div>
            <div>
                <label for="mail">Mail (optional)</label>
                <input id="mail" name="mail" type="email" value="{$newComment.mail}" />
            </div>
            <div>
                <label for="url">URL (optional)</label>
                <input id="url" name="url" type="text" value="{$newComment.url}" />
            </div>
            <div>
                <label for="comment">Bemerkung</label>
                <textarea id="comment" name="comment">{$newComment.comment}</textarea>
            </div>
            <div>
                <label for="captcha">Bitte geben Sie folgenden Text ein:</label>
                <input id="captcha" name="captcha" type="text" required />
                <img src="/?page=captcha&b={$cacheBreaker}">
            </div>
            <input type="submit" value="Absenden" />
        </form>
    </div>
</div>

{include 'footer.tpl'}