<script>
    import { onMount } from 'svelte';
    import Slider from '@smui/slider';
    import StarSlider from "../components/StarSlider.svelte";

	const endpoint = "http://localhost/QuizWiz/backend/categories.php";
    let categories = [];
    let value = 5;
    let diff = 5;

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
	<div id="container">
        <div id="text">
            <h2>Wählen Sie die Anzahl an Fragen aus:</h2>
        </div>
        <div id="slider">
            Anzahl: {value}
            <Slider bind:value min={1} max={10} />
        </div>
    </div>
    <div id="container">
        <div id="text">
            <h2>Wählen Sie die Schwierigkeit der Fragen aus:</h2>
        </div>
        <div id="star">
            Schwierigkeit: {diff}
            <StarSlider bind:value={diff} />
        </div>
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

    #container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }


</style>