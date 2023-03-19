<script>
	export let name;
	const endpoint = "http://localhost/QuizWiz/backend/index.php";
	let posts = [];
	let display = [];
	let select = "Fragestellung";

	async function doPost() {
		console.log(select);

		posts = [];
		const res = await fetch(endpoint, {
			method: 'POST',
			body: JSON.stringify({
				select
			})
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function (key){
			posts.push(JSON.parse(data[key]));
		});

		// svelte pointer wakeup call hhhhhhhhhhhhhhhh
		//posts = posts;
		
		display = [];
		Object.keys(posts).forEach(function (key){
			display.push(posts[key][select]);
		});
		console.log(display);
	}
</script>

<main>
	<h1>Hello {name}!</h1>

	<label>
		<input type=radio bind:group={select} name="select" value="Antwortmoeglichkeit">
		Antwort
	</label>

	<label>
		<input type=radio bind:group={select} name="select" value="Fragestellung" act>
		Fragestellung
	</label>

	<button type="button" on:click={doPost}>
		Post it.
	</button>
	<p>
		Result:
	</p>
	<p>{select}</p>
	{#each display as entry}
    <div>
      <p>{entry}</p>
    </div>
  {/each}
</main>

<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

	@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}
</style>