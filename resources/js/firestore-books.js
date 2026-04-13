import { db } from './firebase';
import {
    doc,
    setDoc,
    deleteDoc,
    getDoc,
    collection,
    onSnapshot,
    query,
    orderBy,
    serverTimestamp,
} from 'firebase/firestore';

/**
 * Save a book to the user's reading list in Firestore.
 */
export async function saveBook(userId, bookData) {
    const bookRef = doc(db, 'users', String(userId), 'savedBooks', bookData.slug);
    await setDoc(bookRef, {
        title: bookData.title,
        author: bookData.author,
        coverImage: bookData.coverImage || null,
        previewUrl: bookData.previewUrl || null,
        slug: bookData.slug,
        savedAt: serverTimestamp(),
    });
}

/**
 * Remove a book from the user's reading list.
 */
export async function unsaveBook(userId, bookSlug) {
    const bookRef = doc(db, 'users', String(userId), 'savedBooks', bookSlug);
    await deleteDoc(bookRef);
}

/**
 * Check if a book is already saved by this user.
 */
export async function isBookSaved(userId, bookSlug) {
    const bookRef = doc(db, 'users', String(userId), 'savedBooks', bookSlug);
    const docSnap = await getDoc(bookRef);
    return docSnap.exists();
}

/**
 * Subscribe to the user's saved books in real-time.
 * Returns an unsubscribe function.
 */
export function onSavedBooksChange(userId, callback) {
    const q = query(
        collection(db, 'users', String(userId), 'savedBooks'),
        orderBy('savedAt', 'desc')
    );
    return onSnapshot(q, (snapshot) => {
        const books = [];
        snapshot.forEach((doc) => {
            books.push({ id: doc.id, ...doc.data() });
        });
        callback(books);
    });
}

/**
 * Update reading progress for a book.
 */
export async function updateReadingProgress(userId, bookSlug, progressData) {
    const progressRef = doc(db, 'users', String(userId), 'readingProgress', bookSlug);
    await setDoc(progressRef, {
        ...progressData,
        lastReadAt: serverTimestamp(),
    }, { merge: true });
}

/**
 * Subscribe to reading progress in real-time.
 */
export function onReadingProgressChange(userId, callback) {
    const q = query(
        collection(db, 'users', String(userId), 'readingProgress'),
        orderBy('lastReadAt', 'desc')
    );
    return onSnapshot(q, (snapshot) => {
        const progress = [];
        snapshot.forEach((doc) => {
            progress.push({ id: doc.id, ...doc.data() });
        });
        callback(progress);
    });
}
