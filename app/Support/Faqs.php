<?php

namespace App\Support;

/**
 * Buyer-facing FAQ copy + FAQPage JSON-LD. Fiction-only answers stay honest.
 */
class Faqs
{
    /**
     * @return list<array{q: string, a: string}>
     */
    public static function forContext(): array
    {
        return match (PageCopy::schemaKeyForContext()) {
            'home' => self::home(),
            'book' => self::book(),
            'listings' => self::listings(),
            default => [],
        };
    }

    /**
     * @return list<array{q: string, a: string}>
     */
    public static function home(): array
    {
        return [
            [
                'q' => 'What should I compare first on a rural Adams County listing?',
                'a' => 'Start with township, price, and usable acres — then water, septic, and legal access. Beds and commute matter on houses; perc status and road frontage matter on land. Sample inventory on this site is fictional, but the scan order is what a working farm buyer uses.',
            ],
            [
                'q' => 'How is buying land different from buying a house here?',
                'a' => 'A house usually has utilities already. Raw acreage often needs a well, a perc test, and a recorded driveway. Zoning and Clean and Green (Act 319) change from North Ridge to Oak Hollow. Read the buyer guide before you write an offer on a parcel with no house.',
            ],
            [
                'q' => 'Do I need a showing to walk a farm or historic house?',
                'a' => 'Yes for occupied homes and most working farms — lanes, livestock, and locked shops are common. Book a sample slot on this demo to see the flow: pick a listing, a date, and a time. Wear boots; mention pets or if you are new to land.',
            ],
            [
                'q' => 'Is Keystone Real Estate a live brokerage?',
                'a' => 'No. This is a concept demo by Ridges & Valleys Studio. Listings, phones, and market stats are fictional. Use it to walk a modern realtor site — then replace sample data with your own inventory.',
            ],
        ];
    }

    /**
     * @return list<array{q: string, a: string}>
     */
    public static function book(): array
    {
        return [
            [
                'q' => 'What should I bring to a rural showing?',
                'a' => 'Boots, a notebook, and questions about the well, septic, and access. If you are shopping land, ask where a house could sit and whether a perc report exists. This demo saves the request only — it does not email or text.',
            ],
            [
                'q' => 'How long is a typical farm or acreage walk-through?',
                'a' => 'Plan 45–90 minutes. A historic house can be shorter; a 30-acre farm with a barn and lane takes longer. Evening slots on this form match how working buyers actually tour after commute hours.',
            ],
            [
                'q' => 'Can I tour land and a house on the same request?',
                'a' => 'Pick one listing per request so the agent preps the right file. Want both a farmhouse and a vacant parcel? Send two showing requests or note it in the comments after you choose the first address.',
            ],
            [
                'q' => 'Does this form schedule a real appointment?',
                'a' => 'No. Submitting creates a Booking post in Requested status for the concept site. Nothing is emailed, texted, or added to a calendar.',
            ],
        ];
    }

    /**
     * @return list<array{q: string, a: string}>
     */
    public static function listings(): array
    {
        return [
            [
                'q' => 'Why do township filters matter more than city names?',
                'a' => 'Adams County zoning, lot-size rules, and Clean and Green enrollment sit at the township. Two parcels a mile apart can have different well, septic, and subdivision answers. Filter by township first, then price and acres.',
            ],
            [
                'q' => 'What does “land” vs “farm” vs “historic” mean here?',
                'a' => 'Land is acreage to build or hold. Farm includes working ground, barns, or orchard. Historic is an older house where the building is the product. Homes are turnkey dwellings. All eight sample cards are fictional.',
            ],
            [
                'q' => 'How do I get from a card to a showing?',
                'a' => 'Open a listing for beds, acres, and the write-up, then use Book a showing with that listing preselected. You can also book from the homepage or /book/ and pick the address there.',
            ],
        ];
    }
}
