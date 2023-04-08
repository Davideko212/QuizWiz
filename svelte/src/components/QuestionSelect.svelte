<script>
    import Slider from '@smui/slider';
    import StarSlider from "../components/StarSlider.svelte";

    export let amount;
    export let diff;
</script>

<main>
	<div id="container">
        <div id="text">
            <h2>Wählen Sie die Anzahl an Fragen aus:</h2>
        </div>
        <div id="slider">
            Anzahl: {amount}
            <Slider bind:value={amount} min={2} max={10} />
        </div>
    </div>
    <div id="container">
        <div id="text">
            <h2>Wählen Sie die max. Schwierigkeit der Fragen aus:</h2>
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
        gap: 40px;
	}

    #container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>