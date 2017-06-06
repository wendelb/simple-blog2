{include 'header.tpl'}
<div class="new-article">
    <h2>
        {if $id != 'new'}
            Eintrag bearbeiten
        {else}
            Neuen Eintrag hinzufügen
        {/if}
    </h2>
    <form action="/" method="post">
    	<input type="hidden" name="page" value="newpage" />
        <input type="hidden" name="id" value="{$id}" />
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" required value="{$title}"/>
        <div class="clearfix"></div>
        <textarea class="tinymce" name="content">{$content}</textarea>
        <input type="submit" value="Veröffentlichen..." />
    </form>
</div>
{include 'footer.tpl'}