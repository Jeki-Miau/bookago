import { storage } from './firebase';
import { ref, uploadBytes, getDownloadURL } from 'firebase/storage';

/**
 * Upload a book cover image to Firebase Storage.
 * Returns the public download URL.
 */
export async function uploadBookCover(file, bookSlug) {
    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        throw new Error('Format file tidak didukung. Gunakan JPEG, PNG, atau WebP.');
    }

    // Validate file size (max 2MB)
    const maxSize = 2 * 1024 * 1024;
    if (file.size > maxSize) {
        throw new Error('Ukuran file terlalu besar. Maksimal 2MB.');
    }

    const storageRef = ref(storage, `covers/${bookSlug}_${Date.now()}`);
    const snapshot = await uploadBytes(storageRef, file);
    const downloadURL = await getDownloadURL(snapshot.ref);
    return downloadURL;
}
