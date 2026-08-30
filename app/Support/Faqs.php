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
                'a' => 'Start with township, price, and usable acres, then water, septic, and legal access. Bedrooms and commute matter on houses; perc status and road frontage matter on land. Inventory on this site is sample data; the review order is what a working farm buyer uses.',
            ],
            [
                'q' => 'How is buying land different from buying a house here?',
                'a' => 'A house usually has utilities in place. Raw acreage often needs a well, a perc test, and a recorded driveway. Zoning and Clean and Green (Act 319) change from North Ridge to Oak Hollow. Review the buyer guide before you write an offer on a parcel without a house.',
            ],
            [
                'q' => 'Do I need a showing to walk a farm or historic house?',
                'a' => 'Yes for occupied homes and most working farms — lanes, livestock, and locked shops are common. Schedule a sample showing to see the flow: choose a listing, a date, and a time. Wear boots, and mention pets or if you are new to land.',
            ],
            [
                'q' => 'Is Keystone Real Estate a live brokerage?',
                'a' => 'No. This is a concept site by Ridges & Valleys Studio. Listings, phone numbers, and market figures are fictional. Use it to evaluate a modern realtor website, then replace the sample data with your own inventory.',
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
                'q' => 'Why filter by township before city?',
                'a' => 'Zoning, lot-size rules, and Clean and Green sit at the township. Two parcels a mile apart can have different well, septic, and subdivision answers. Pick a township first, then price and acres.',
            ],
            [
                'q' => 'What do Land, Farm, and Historic mean?',
                'a' => 'Land is acreage to build or hold. Farm includes working ground, barns, or orchard. Historic is an older house where the building is the product. Home is a turnkey dwelling. All eight cards are fictional samples.',
            ],
            [
                'q' => 'How do I get from a card to a showing?',
                'a' => 'Open a listing for beds, acres, and the write-up, then Book a showing — that address is preselected. You can also start from the homepage or /book/ and pick the listing there.',
            ],
            [
                'q' => 'Is this a live MLS feed?',
                'a' => 'No. Prices, addresses, and township labels are concept data for this demo. Use the filters to see how a working farm search should feel, then replace the sample inventory with a real feed.',
            ],
        ];
    }
}
