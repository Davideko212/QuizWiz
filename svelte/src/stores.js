import { writable } from 'svelte/store';

export const questions = writable([]);
export const lightmode = writable(true);
// this is absolutely not secure but it works
// 0 means no user is logged on
export const userID = writable(0);