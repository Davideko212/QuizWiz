import { writable } from 'svelte/store';

//const storedQuestions = localStorage.getItem("questions");
export const questions = writable([]);
export const answers = writable({});
export const lightmode = writable(true);
// this is absolutely not secure but it works
// 0 means no user is logged on
export const userID = writable(0);

if (typeof localStorage != 'undefined') {
    const questionsStore = localStorage.getItem("questions");
    if (!(questionsStore == null || questionsStore === "undefined")) {
        questions.set(JSON.parse(questionsStore));
    }
    questions.subscribe(value => {
        localStorage.setItem("questions", JSON.stringify(value));
    })

    const answersStore = localStorage.getItem("answers");
    if (!(answersStore == null || answersStore === "undefined")) {
        answers.set(JSON.parse(answersStore));
    }
    answers.subscribe(value => {
        localStorage.setItem("answers", JSON.stringify(value));
    })

    lightmode.set(localStorage.getItem("modeCurrent") === "true");

    const userIDStore = localStorage.getItem("userID");
    if (!(userIDStore == null)) {
        userID.set(+userIDStore);
    }
    userID.subscribe(value => {
        localStorage.setItem("userID", value.toString());
    })
}