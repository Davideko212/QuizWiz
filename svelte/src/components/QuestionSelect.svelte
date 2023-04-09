<script>
    import { RangeSlider } from '@skeletonlabs/skeleton';
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
            <RangeSlider name="range-slider" bind:value={amount} min={2} max={10} step={1} ticked>
                <div class="flex justify-between items-center">
                    <div class="font-bold">Anzahl Fragen</div>
                    <div class="text-xs">{amount} / 10</div>
                </div>
            </RangeSlider>
        </div>
    </div>
    <div id="container">
        <div id="text">
            <h2>Wählen Sie die max. Schwierigkeit der Fragen aus:</h2>
        </div>
        <div id="star">
            Max. Schwierigkeit: {diff}
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
        gap: 6px;
    }

    #slider, #star {
        min-width: 50%;
    }

    #star {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>