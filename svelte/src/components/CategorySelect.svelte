<script lang="ts">
    import { onMount } from 'svelte';

    export let categoriesSelected: Array<string>;

	const endpoint = "http://localhost/QuizWiz/backend/categories.php";
    let categories: Array<string> = [];

    onMount(async () => {
		const res = await fetch(endpoint, {
			method: 'GET'
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function(key) {
			categories.push(data[key]);
		});

        categories = categories;
	});
</script>

<main>
	<div id="text">
        <h2>Wählen Sie mindestens eine Kategorie aus:</h2>
    </div>
    <div id="boxes">
        {#each categories as entry}
            <div id="entry">
                <input type="checkbox" id={entry} bind:group={categoriesSelected} value={entry}><label for="{entry}">{entry}</label>
            </div>
        {/each}
    </div>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
	}

    input {
        margin: 0;
    }

    #boxes {
        display: flex;
        flex-direction: column;
    }

    #entry {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
        font-size: large;
    }
</style>