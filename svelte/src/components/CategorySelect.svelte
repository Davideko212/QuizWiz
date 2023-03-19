<script>
    import { onMount } from 'svelte';

	const endpoint = "http://localhost/QuizWiz/backend/categories.php";
    let categories = [];

    onMount(async () => {
		const res = await fetch(endpoint, {
			method: 'GET'
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function (key){
			categories.push(data[key]);
		});

        console.log(categories);
        categories = categories;
	});
</script>

<main>
	<div id="text">
        <h1>Wählen Sie mindestens eine Kategorie aus:</h1>
    </div>
    <div id="boxes">
        {#each categories as entry}
            <div id="entry">
                <input type="checkbox">{entry}
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
	}

    input {
        margin: 0;
    }

    h1 {
        font-size: 20px;
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
    }
</style>