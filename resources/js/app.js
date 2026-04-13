import './bootstrap';
import { app, db, storage } from './firebase';
import { saveBook, unsaveBook, isBookSaved, onSavedBooksChange, updateReadingProgress, onReadingProgressChange } from './firestore-books';
import { uploadBookCover } from './firebase-storage';

// Expose Firebase helpers to Alpine.js via window
window.firebaseHelpers = {
    saveBook,
    unsaveBook,
    isBookSaved,
    onSavedBooksChange,
    updateReadingProgress,
    onReadingProgressChange,
    uploadBookCover,
};

console.log('🔥 Firebase initialized for BOOKAGO');
